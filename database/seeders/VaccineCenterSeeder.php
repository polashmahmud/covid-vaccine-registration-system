<?php

namespace Database\Seeders;

use App\Models\VaccineCenter;
use Illuminate\Database\Seeder;

class VaccineCenterSeeder extends Seeder
{
    public function run()
    {
        VaccineCenter::factory()->count(20)->create();
    }
}
