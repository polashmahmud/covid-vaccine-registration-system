<?php

namespace App\Http\Controllers;

use App\Http\Requests\VaccineScheduleRequest;
use App\Http\Resources\RegistrationResource;
use App\Http\Resources\VaccineCenterResource;
use App\Models\VaccineCenter;

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
        // update the user's registration with the selected vaccine center
        \Auth::user()->registration->update([
            'vaccine_center_id' => $request->vaccine_center_id,
            'scheduled_date' => $request->scheduled_date,
        ]);
    }
}
