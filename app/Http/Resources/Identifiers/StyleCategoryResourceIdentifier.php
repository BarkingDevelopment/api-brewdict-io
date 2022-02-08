<?php

namespace App\Http\Resources\Identifiers;

use Illuminate\Http\Resources\Json\JsonResource;

class StyleCategoryResourceIdentifier extends JsonResource
{
    use ResourceIdentifier;

    static string $TYPE = "style_category";
}
