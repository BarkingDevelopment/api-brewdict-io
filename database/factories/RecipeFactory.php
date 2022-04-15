<?php

namespace Database\Factories;

use App\Enums\RecipeState;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
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
            "description" => $this->faker->text(),
            "state" => RecipeState::Published(),
            "og" => $this->faker->randomFloat(3, 1.02, 1.1),
            "fg" => $this->faker->randomFloat(3, 1, 1.02),
            "ibu" => $this->faker->numberBetween(0, 120),
            "srm" => $this->faker->numberBetween(1, 40),
        ];
    }
}
