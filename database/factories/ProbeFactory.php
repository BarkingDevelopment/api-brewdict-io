<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProbeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "mac" => $this->faker->macAddress(),
            "name" => $this->faker->name(),
            "colour" => $this->faker->safeColorName(),
        ];
    }
}
