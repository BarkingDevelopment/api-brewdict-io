<?php

namespace App\Http\Resources\Identifiers;

use Illuminate\Http\Resources\Json\JsonResource;

class FermentationResourceIdentifier extends JsonResource
{
    use ResourceIdentifier;

    static string $TYPE = "fermentation";
}
