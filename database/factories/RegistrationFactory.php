<?php

namespace Database\Factories;

use App\Models\Registration;
use App\Models\User;
use App\Models\VaccineCenter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class RegistrationFactory extends Factory
{
    protected $model = Registration::class;

    public function definition()
    {
        $status = $this->faker->randomElement(['not_scheduled', 'scheduled', 'vaccinated']);

       // Generate a random date that is either Sunday or Thursday
        $scheduledDate = null;
        if ($status !== 'not_scheduled') {
            $date = Carbon::now();
            $possibleDates = [];

            while ($date->lte(Carbon::now()->addMonth())) {
                if (in_array($date->dayOfWeek, [Carbon::SUNDAY, Carbon::THURSDAY])) {
                    $possibleDates[] = $date->copy();
                }
                $date->addDay();
            }

            $scheduledDate = Arr::random($possibleDates);
        }

        return [
            'status' => $status,
            'scheduled_date' => $scheduledDate,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => User::factory(),
            'vaccine_center_id' => VaccineCenter::all()->random()->id,
        ];
    }
}
