<?php

namespace Database\Seeders;

use App\Models\Registration;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    public function run()
    {
        Registration::factory(1000)->create();
    }
}
