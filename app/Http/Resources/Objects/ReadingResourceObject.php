<?php

namespace App\Http\Resources\Objects;

use App\Http\Resources\Identifiers\FermentationResourceIdentifier;
use App\Http\Resources\Identifiers\ProbeResourceIdentifier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReadingResourceObject extends JsonResource
{
    const TYPE = "readings";

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
                "type" => $this->type,
                "value" => $this->value,
                "units" => $this->units,
                "recorded_at" => $this->recorded_at,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
            ],
            "relationship" => [
                FermentationResourceObject::TYPE => [
                    "data" => new FermentationResourceIdentifier($this->fermentation),
                    "links" => [
                        "self" => $_ENV["APP_URL"] . "/api/" . FermentationResourceObject::TYPE . "/" . $this->probe->id,
                    ],
                ],
                ProbeResourceObject::TYPE => [
                    "data" => new ProbeResourceIdentifier($this->probe),
                    "links" => [
                        "self" => $_ENV["APP_URL"] . "/api/" . ProbeResourceObject::TYPE . "/" . $this->probe->id,
                    ],
                ],
            ],
            "links" => [
                "self" => $SELF_LINK,
            ],
        ];
    }
}
