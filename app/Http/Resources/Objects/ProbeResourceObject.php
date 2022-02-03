<?php

namespace App\Http\Resources\Objects;

use App\Http\Resources\Identifiers\FermentationResourceIdentifier;
use App\Http\Resources\Identifiers\ProbeStateResourceIdentifier;
use App\Http\Resources\Identifiers\UserResourceIdentifier;
use Illuminate\Http\Request;

class ProbeResourceObject extends ResourceObject
{
    const TYPE = "probe";

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
            "attributes" => [
                "name" => $this->name,
                "colour" => $this->colour,
                "chip_id" => $this->chip_id,
                "mac" => $this->mac,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
            ],
            "relationships" => [
                "user" => [
                    "data" => new UserResourceIdentifier($this->owner())
                ],
                "status" => [
                    "data" => new ProbeStateResourceIdentifier($this->status())
                ],
                "current_fermentation" => [
                    "data" => new FermentationResourceIdentifier($this->currentFermentation())
                ],
            ]
        ];
    }
}
