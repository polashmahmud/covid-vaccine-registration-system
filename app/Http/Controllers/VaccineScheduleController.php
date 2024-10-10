<?php

namespace App\Http\Controllers;

use App\Http\Requests\VaccineScheduleRequest;
use App\Http\Resources\RegistrationResource;
use App\Http\Resources\VaccineCenterResource;
use App\Models\VaccineCenter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class VaccineScheduleController extends Controller
{
    public function index()
    {
        return inertia()->render('VaccineSchedule', [
            'vaccineCenters' => VaccineCenterResource::collection(VaccineCenter::paginate()),
            'vaccineCenter' => RegistrationResource::make(\Auth::user()->registration->load('vaccineCenter')),
        ]);
    }

    public function store(VaccineScheduleRequest $request)
    {
        // Find the vaccine center
        $vaccineCenter = VaccineCenter::findOrFail($request->vaccine_center_id);

        // Create a lock for scheduling
        $lockKey = 'vaccine_schedule_'.$vaccineCenter->id.'_'.Str::replace('-', '_', $request->scheduled_date);
        $lock = Cache::lock($lockKey, 10);

        if (!$lock->get()) {
            return back()->withErrors('scheduled_date', 'Failed to schedule vaccine. Please try again.');
        }

        try {
            // Check if the vaccine center is fully booked for the scheduled date
            $isFullyBooked = $vaccineCenter->registrations()
                    ->where('scheduled_date', $request->scheduled_date)
                    ->count() >= $vaccineCenter->daily_capacity;

            if ($isFullyBooked) {
                return back()->withErrors(['scheduled_date' => 'No available slot for this date. Please choose another date.']);
            }

            // Update user's vaccine registration
            $request->user()->registration->update([
                'vaccine_center_id' => $request->vaccine_center_id,
                'scheduled_date' => $request->scheduled_date,
                'status' => 'scheduled',
            ]);

            return redirect()->route('home')->with('success', 'Vaccine scheduled successfully.');

        } catch (\Exception $e) {
            return back()->withErrors('scheduled_date', 'Failed to schedule vaccine. Please try again.');
        } finally {
            $lock->release();
        }
    }
}
