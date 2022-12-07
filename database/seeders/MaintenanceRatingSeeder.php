<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MaintenanceRating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MaintenanceRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MaintenanceRating::factory()->times(10)->create();

    }
}
