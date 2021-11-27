<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StyleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->text(16),
            "style_letter" => $this->faker->randomLetter(),
            "type" => $this->faker->randomElement(["ale", "lager", "wild", "mixed"]),
            "og_min" => $this->faker->randomFloat(5, 1.05, 1.08),
            "og_max" => $this->faker->randomFloat(5, 1.03, 1.05),
            "fg_min" => $this->faker->randomFloat(5, 1, 1.005),
            "fg_max" => $this->faker->randomFloat(5, 1.005, 1.02),
            "ibu_min" => $this->faker->numberBetween(0, 50),
            "ibu_max" => $this->faker->numberBetween(50,100),
            "srm_min" => $this->faker->numberBetween(1, 10),
            "srm_max" => $this->faker->numberBetween(10, 20),
            "notes" => $this->faker->text(),
        ];
    }
}
