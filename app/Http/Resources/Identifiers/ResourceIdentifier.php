<?php

namespace App\Http\Resources\Identifiers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class ResourceIdentifier extends JsonResource
{
    const TYPE = "null";

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "type" => self::TYPE,
            "id" => $this->id,
        ];
    }
}
