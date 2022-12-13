<?php

namespace Database\Seeders;

use App\Models\Plant;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

//run seeder to insert factory data into the database

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create 5 instances of factory
        Category::factory()
        ->times(5)
        ->create();

        //attach 2 or 3 random plants to each category
        foreach(Category::all() as $category){
            $plants = Plant::inRandomOrder()->take(rand(1,3))->pluck('id');
            $category->plants()->attach($plants);
        }
    }
}
