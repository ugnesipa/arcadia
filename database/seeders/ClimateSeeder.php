<?php

namespace Database\Seeders;

use App\Models\Climate;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClimateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Climate::factory()
        ->times(6)
        ->hasPlants(5)
        ->create();
    }
}
