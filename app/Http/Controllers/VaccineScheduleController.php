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
        $vaccineCenter = VaccineCenter::findOrFail($request->vaccine_center_id);

        $lock = Cache::lock('vaccine_schedule_' . $vaccineCenter->id. '_'. Str::replace('-', '_', $request->scheduled_date),
            10);

        if (!$lock->get()) {
            return back()->withErrors('scheduled_date', 'Failed to schedule vaccine. Please try again.');
        }

        try {
            // Vaccine center availability check
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

            return back()->with('success', 'Vaccine schedule updated successfully.');

        } catch (\Exception $e) {
            return back()->withErrors('scheduled_date', 'Failed to schedule vaccine. Please try again.');
        } finally {
            $lock->release();
        }
    }
}
