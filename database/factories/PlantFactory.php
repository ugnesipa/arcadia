<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plant>
 */
class PlantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'name' => $this->faker->word,
            'category' => $this->faker->text(50),
            'origin' => $this->faker->word,
            'climate' => $this->faker->word,
            'maintenance_rating' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->text(100),

        ];
    }
}
