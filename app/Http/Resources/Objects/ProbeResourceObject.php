<?php

namespace App\Http\Resources\Objects;

use App\Http\Resources\Identifiers\FermentationResourceIdentifier;
use App\Http\Resources\Identifiers\ProbeStateResourceIdentifier;
use App\Http\Resources\Identifiers\UserResourceIdentifier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProbeResourceObject extends JsonResource
{
    const TYPE = "probes";

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
                "name" => $this->name,
                "colour" => $this->colour,
                "chip_id" => $this->chip_id,
                "mac" => $this->mac,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
            ],
            "relationships" => [
                UserResourceObject::TYPE => [
                    "data" => new UserResourceIdentifier($this->owner),
                    "links" => [
                        "self" => $_ENV["APP_URL"] . "/api/" . UserResourceObject::TYPE . "/" . $this->owner->id,
                    ],
                ],
                "status" => [
                    "data" => new ProbeStateResourceIdentifier($this->status),
                    "links" => [
                        "self" => $_ENV["APP_URL"] . "/api/" . ProbeStateResourceObject::TYPE . "/" . $this->status->id,
                        "related" => $SELF_LINK . "/" . "states",
                    ],
                ],
                "current_fermentation" => [
                    "data" => new FermentationResourceIdentifier($this->currentFermentation),
                    "links" => [
                        "self" => $_ENV["APP_URL"] . "/api/" . FermentationResourceObject::TYPE . "/" . $this->currentFermentation->id,
                    ],
                ],
                "reading" => [
                    "data" => new FermentationResourceIdentifier($this->latestReading),
                    "links" => [
                        "self" => $_ENV["APP_URL"] . "/api/" . FermentationResourceObject::TYPE . "/" . $this->latestReading->id,
                        "related" => $SELF_LINK . "/" . "readings",
                    ],
                ],
            ],
            "links" => [
                "self" => $SELF_LINK,
            ],
        ];
    }
}
