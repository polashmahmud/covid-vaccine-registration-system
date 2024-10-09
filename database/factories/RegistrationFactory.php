<?php

namespace Database\Factories;

use App\Models\Registration;
use App\Models\User;
use App\Models\VaccineCenter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RegistrationFactory extends Factory
{
    protected $model = Registration::class;

    public function definition()
    {
        return [
            'scheduled_date' => Carbon::now(),
            'status' => $this->faker->randomElement(['not_scheduled', 'scheduled', 'vaccinated']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
            'vaccine_center_id' => VaccineCenter::factory(),
        ];
    }
}
