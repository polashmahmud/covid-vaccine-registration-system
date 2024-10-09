<?php

namespace App\Http\Controllers;

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
}
