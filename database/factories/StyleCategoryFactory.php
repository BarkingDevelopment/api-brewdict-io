<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StyleCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "number" => $this->faker->numberBetween(0, 50),
            "name" => $this->faker->text(16),
            "style_guide" => $this->faker->randomElement(["BJCP", "BA", "CAMRA"]),
            "description" => $this->faker->text(),
        ];
    }
}
