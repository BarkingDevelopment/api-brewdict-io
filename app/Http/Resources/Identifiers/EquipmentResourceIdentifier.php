<?php

namespace App\Http\Resources\Identifiers;

use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentResourceIdentifier extends JsonResource
{
    use ResourceIdentifier;

    static string $TYPE = "equipment";
}
