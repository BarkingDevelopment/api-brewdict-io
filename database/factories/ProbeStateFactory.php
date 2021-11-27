<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProbeStateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "recorded_at" => $this->faker->dateTimeInInterval("-1 week", "+1 hour"),
            "battery" => $this->faker->randomFloat(2, 0, 1000000),
            "signal_strength" => $this->faker->randomNumber(),
        ];
    }
}
