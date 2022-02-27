<?php

namespace App\Http\Resources\Identifiers;

use Illuminate\Http\Resources\Json\JsonResource;

class ProbeResourceIdentifier extends JsonResource
{
    use ResourceIdentifier;

    static string $TYPE = "probe";
}
