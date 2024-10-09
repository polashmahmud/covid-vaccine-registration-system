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
            'name' => $this->faker->name(),
            'location' => $this->faker->word(),
            'daily_capacity' => $this->faker->numberBetween(50, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
