<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FermentationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "started_at" => $this->faker->dateTime(),
            "og" => $this->faker->randomFloat(5, 1.03, 1.05),
            "completed" => $this->faker->boolean(20)
        ];
    }
}
