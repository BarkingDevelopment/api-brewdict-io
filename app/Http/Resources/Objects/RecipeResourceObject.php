<?php

namespace App\Http\Resources\Objects;

use App\Http\Resources\Identifiers\RecipeResourceIdentifier;
use App\Http\Resources\Identifiers\StyleResourceIdentifier;
use App\Http\Resources\Identifiers\UserResourceIdentifier;
use Illuminate\Http\Request;

class RecipeResourceObject extends ResourceObject
{
    const TYPE = "recipe";

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
                "description" => $this->description,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
            ],
            "relationship" => [
                "owner" => [
                    "data" => new UserResourceIdentifier($this->owner()),
                ],
                "inspiration" => [
                    "data" => !is_null($this->parent()) ? new RecipeResourceIdentifier($this->parent()) : "null",
                ],
                "style" => [
                    "data" => new StyleResourceIdentifier($this->style()),
                ],
            ],
        ];
    }
}
