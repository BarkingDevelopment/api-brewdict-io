<?php

namespace App\Http\Resources\Identifiers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StyleResourceIdentifier extends JsonResource
{
    use ResourceIdentifier;

    static string $TYPE = "style";
}
