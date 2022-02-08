<?php

namespace App\Http\Resources\Identifiers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResourceIdentifier extends JsonResource
{
    use ResourceIdentifier;

    static string $TYPE = "user";
}
