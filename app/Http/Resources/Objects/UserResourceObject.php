<?php

namespace App\Http\Resources\Objects;

use App\Http\Resources\Identifiers\FermentationResourceIdentifier;
use App\Http\Resources\Identifiers\ProbeResourceIdentifier;
use App\Http\Resources\Identifiers\RecipeResourceIdentifier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResourceObject extends JsonResource
{
    const TYPE = "users";

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
                "username" => $this->username,
                "email" => $this->email,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
            ],
            "relationship" => [
                RecipeResourceObject::TYPE => [
                    "data" => RecipeResourceIdentifier::collection($this->recipes),
                    "links" => [
                        "related" => $SELF_LINK . "/" . RecipeResourceObject::TYPE,
                    ],
                ],
                FermentationResourceObject::TYPE => [
                    "data" => FermentationResourceIdentifier::collection($this->fermentations),
                    "links" => [
                        "related" => $SELF_LINK . "/" . FermentationResourceObject::TYPE,
                    ],
                ],
                ProbeResourceObject::TYPE => [
                    "data" => ProbeResourceIdentifier::collection($this->probes),
                    "links" => [
                        "related" => $SELF_LINK . "/" . ProbeResourceObject::TYPE,
                    ],
                ],
            ],
            "links" => [
                "self" => $SELF_LINK,
            ],
        ];
    }
}
