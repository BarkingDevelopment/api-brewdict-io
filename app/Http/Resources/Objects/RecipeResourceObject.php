<?php

namespace App\Http\Resources\Objects;

use App\Http\Resources\Identifiers\RecipeResourceIdentifier;
use App\Http\Resources\Identifiers\StyleResourceIdentifier;
use App\Http\Resources\Identifiers\UserResourceIdentifier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResourceObject extends JsonResource
{
    const TYPE = "recipes";

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
                "description" => $this->description,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
            ],
            "relationship" => [
                "owner" => [
                    "data" => new UserResourceIdentifier($this->owner),
                    "links" => [
                        "self" => $_ENV["APP_URL"] . "/api/" . UserResourceObject::TYPE . "/" . $this->owner->id,
                    ],
                ],
                "inspiration" => [
                    "data" => !is_null($this->parent) ? new RecipeResourceIdentifier($this->parent) : "null",
                    "links" => !is_null($this->parent) ? [
                        "self" => $_ENV["APP_URL"] . "/api/" . RecipeResourceObject::TYPE . "/" . $this->parent->id,
                    ] : [],
                ],
                StyleResourceObject::TYPE => [
                    "data" => new StyleResourceIdentifier($this->style),
                    "links" => [
                        "self" => $_ENV["APP_URL"] . "/api/" . StyleResourceObject::TYPE . "/" . $this->style->id,
                    ],
                ],
            ],
            "links" => [
                "self" => $SELF_LINK,
            ],
        ];
    }
}
