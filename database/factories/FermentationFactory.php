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
            "completed" => $this->faker->boolean(20)
        ];
    }
}
