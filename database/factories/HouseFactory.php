<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HouseFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->words(2, true),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 100000, 2000000),
            'location' => fake()->city() . ', ' . fake()->stateAbbr(),
        ];
    }
}