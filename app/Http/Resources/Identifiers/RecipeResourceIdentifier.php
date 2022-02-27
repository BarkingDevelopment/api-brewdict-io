<?php

namespace App\Http\Resources\Identifiers;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResourceIdentifier extends JsonResource
{
    use ResourceIdentifier;

    static string $TYPE = "recipe";
}
