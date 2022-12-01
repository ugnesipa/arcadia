<?php

namespace Database\Seeders;

use App\Models\Climate;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

//run seeder to insert factory data into the database

class ClimateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Climate::factory()->times(20)->create();
    }
}
