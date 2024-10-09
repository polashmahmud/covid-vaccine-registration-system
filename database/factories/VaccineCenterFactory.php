<?php

namespace Database\Factories;

use App\Models\VaccineCenter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class VaccineCenterFactory extends Factory
{
    protected $model = VaccineCenter::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'location' => $this->faker->locale(),
            'daily_capacity' => $this->faker->numberBetween(10, 50),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
