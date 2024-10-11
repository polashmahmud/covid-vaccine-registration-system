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

        return Cache::lock($lockKey, 10)->block(5, function () use ($request, $vaccineCenter) {
            if ($this->isFullyBooked($vaccineCenter, $request->scheduled_date)) {
                return back()->withErrors(['scheduled_date' => 'No available slot for this date. Please choose another date.']);
            }

            $this->scheduleVaccine($request);

            return redirect()->route('home')->with('success', 'Vaccine scheduled successfully.');
        });
    }

    private function isFullyBooked($vaccineCenter, $scheduledDate)
    {
        return $vaccineCenter->registrations()
                ->where('scheduled_date', $scheduledDate)
                ->count() >= $vaccineCenter->daily_capacity;
    }

    private function scheduleVaccine($request)
    {
        $request->user()->registration->update([
            'vaccine_center_id' => $request->vaccine_center_id,
            'scheduled_date' => $request->scheduled_date,
            'status' => 'scheduled',
        ]);
    }
}
