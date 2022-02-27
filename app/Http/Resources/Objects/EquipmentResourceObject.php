<?php

namespace App\Http\Resources\Objects;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentResourceObject extends JsonResource
{
    const TYPE = "equipments";

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
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at
            ],
            "relationship" => [],
            "links" => [
                "self" => $SELF_LINK,
            ],
        ];
    }
}
