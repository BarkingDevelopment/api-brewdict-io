<?php

namespace App\Http\Resources\Objects;

use App\Http\Resources\Identifiers\EquipmentResourceIdentifier;
use App\Http\Resources\Identifiers\ProbeResourceIdentifier;
use App\Http\Resources\Identifiers\ReadingResourceIdentifier;
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
        $SELF_LINK = $_ENV["APP_URL"] . "/api/" . self::TYPE . "/" . $this->id;

        return [
            "type" => self::TYPE,
            "id" => $this->id,
            "attributes" => [
                "started_at" => $this->started_at,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at
            ],
            "relationships" => [
                RecipeResourceObject::TYPE => [
                    "data" => new RecipeResourceIdentifier($this->recipe),
                    "links" => [
                        "self" => $_ENV["APP_URL"] . "/api/" . ProbeResourceObject::TYPE. "/" . $this->recipe->id,
                    ],
                ],
                "brewer" => [
                    "data" => new UserResourceIdentifier($this->brewer),
                    "links" => [
                        "self" => $_ENV["APP_URL"] . "/api/" . ProbeResourceObject::TYPE . "/" . $this->brewer->id,
                    ],
                ],
                EquipmentResourceObject::TYPE => [
                    "data" => new EquipmentResourceIdentifier($this->equipment),
                    "links" => [
                        "self" => $_ENV["APP_URL"] . "/api/" . EquipmentResourceObject::TYPE . "/" . $this->equipment->id,
                    ],
                ],
                ProbeResourceObject::TYPE => [
                    "data" => ProbeResourceIdentifier::collection($this->probes),
                    "links" => [
                        "related" => $SELF_LINK . "/" . ProbeResourceObject::TYPE,
                    ],
                ],
                ReadingResourceObject::TYPE => [
                    "data" => ReadingResourceIdentifier::collection($this->readings),
                    "links" => [
                        "related" => $SELF_LINK . "/" . ReadingResourceObject::TYPE,
                    ],
                ],
            ],
            "links" => [
                "self" => $SELF_LINK,
            ],
        ];
    }
}
