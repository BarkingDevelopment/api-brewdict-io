<?php

namespace Database\Seeders;

use App\Models\Fermentation;
use App\Models\Probe;
use App\Models\ProbeAssignment;
use App\Models\ProbeState;
use App\Models\Reading;
use App\Models\Recipe;
use App\Models\Style;
use App\Models\StyleCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()
            ->count(5)
            ->create();

        $users[] = User::factory()->admin()->create();

        $categories = StyleCategory::factory()
            ->count(30)
            ->create();

        foreach ($categories as $c){
            Style::factory()
                ->count(5)
                ->for($c)
                ->create();
        }

        $styles = Style::all();

        foreach ($users as $u) {
            // Recipes
            for ($i = 0; $i < 5; $i++){
                Recipe::factory()
                    ->state([
                        "style_id" => $styles->random(1)->first()->id
                    ])
                    ->for($u, "owner")
                    ->create();
            }

            $recipes = Recipe::where("owner_id", $u->id)
                ->get();

            // Probes
            for ($i = 0; $i < 3; $i++){
                Probe::factory()
                    // Probe states
                    ->has(ProbeState::factory()
                        ->count(15), "statistics"
                    )->for($u, "owner")
                    ->create();
            }

            $probes= Probe::where("owner_id", $u->id)
                ->get();

            // Fermentations
            for ($i = 0; $i < 10; $i++) {
                $p = $probes->random(1)->first()->id;
                Fermentation::factory()
                    ->state([
                        "brewed_by" => $u->id,
                        "recipe_id" => $recipes->random(1)->first()->id
                    ])
                    // Readings
                    ->has(Reading::factory()
                        ->state([
                            "probe_id" => $p,
                        ])
                        ->count(15)
                    )
                    ->create();
            }
        }
    }
}
