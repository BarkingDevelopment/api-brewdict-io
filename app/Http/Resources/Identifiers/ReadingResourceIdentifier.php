<?php

namespace App\Http\Resources\Identifiers;

use Illuminate\Http\Resources\Json\JsonResource;

class ReadingResourceIdentifier extends JsonResource
{
    use ResourceIdentifier;

    static string $TYPE = "reading";
}
