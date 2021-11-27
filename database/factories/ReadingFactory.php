<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReadingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "type" => $this->faker->randomElement(["temperature", "density", "ph", "ferm_pressure", "ambient_temp", "altitude"]),
            "recorded_at" => $this->faker->dateTimeInInterval("-1 week", "+1 hour"),
            "value" => $this->faker->randomFloat(5, -10000, 10000),
            "units" => $this->faker->randomElement(["C", "F", "K", "SG", "Brix", "Plato", "kPa", "bar", "psi", "miles", "km", "feet"]),
        ];
    }
}
