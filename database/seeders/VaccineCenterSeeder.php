<?php

namespace Database\Seeders;

use App\Models\VaccineCenter;
use Illuminate\Database\Seeder;

class VaccineCenterSeeder extends Seeder
{
    public function run()
    {
        $nameAndLocation = [
            ['name' => 'Dhaka Medical College Hospital', 'location' => 'Dhaka'],
            ['name' => 'Chittagong Medical College Hospital', 'location' => 'Chittagong'],
            ['name' => 'Rajshahi Medical College Hospital', 'location' => 'Rajshahi'],
            ['name' => 'Khulna Medical College Hospital', 'location' => 'Khulna'],
            ['name' => 'Barishal Medical College Hospital', 'location' => 'Barishal'],
            ['name' => 'Sylhet Medical College Hospital', 'location' => 'Sylhet'],
            ['name' => 'Rangpur Medical College Hospital', 'location' => 'Rangpur'],
            ['name' => 'Mymensingh Medical College Hospital', 'location' => 'Mymensingh'],
            ['name' => 'Comilla Medical College Hospital', 'location' => 'Comilla'],
            ['name' => 'Jessore Medical College Hospital', 'location' => 'Jessore'],
            ['name' => 'Cox\'s Bazar Medical College Hospital', 'location' => 'Cox\'s Bazar'],
            ['name' => 'Dinajpur Medical College Hospital', 'location' => 'Dinajpur'],
            ['name' => 'Faridpur Medical College Hospital', 'location' => 'Faridpur'],
            ['name' => 'Pabna Medical College Hospital', 'location' => 'Pabna'],
            ['name' => 'Noakhali Medical College Hospital', 'location' => 'Noakhali'],
            ['name' => 'Bogra Medical College Hospital', 'location' => 'Bogra'],
            ['name' => 'Kushtia Medical College Hospital', 'location' => 'Kushtia'],
            ['name' => 'Satkhira Medical College Hospital', 'location' => 'Satkhira'],
            ['name' => 'Tangail Medical College Hospital', 'location' => 'Tangail'],
            ['name' => 'Jamalpur Medical College Hospital', 'location' => 'Jamalpur'],
        ];

        foreach ($nameAndLocation as $center) {
            VaccineCenter::create([
                'name' => $center['name'],
                'location' => $center['location'],
                'daily_capacity' => rand(10, 50),
            ]);
        }
    }
}
