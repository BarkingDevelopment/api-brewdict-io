<?php

namespace App\Http\Resources\Objects;

use App\Http\Resources\Identifiers\EquipmentResourceIdentifier;
use App\Http\Resources\Identifiers\ProbeResourceIdentifierCollection;
use App\Http\Resources\Identifiers\ReadingResourceIdentifierCollection;
use App\Http\Resources\Identifiers\RecipeResourceIdentifier;
use App\Http\Resources\Identifiers\UserResourceIdentifier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FermentationResourceObject extends JsonResource
{
    const TYPE = "fermentations";

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
                "started_at" => $this->started_at,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at
            ],
            "relationships" => [
                "recipe" => [
                    "data" => new RecipeResourceIdentifier($this->recipe())
                ],
                "brewer" => [
                    "data" => new UserResourceIdentifier($this->brewer())
                ],
                "equipment" => [
                    "data" => new EquipmentResourceIdentifier($this->equipment())
                ],
                new ProbeResourceIdentifierCollection($this->probes()),
                new ReadingResourceIdentifierCollection($this->readings()),
            ]
        ];
    }
}
