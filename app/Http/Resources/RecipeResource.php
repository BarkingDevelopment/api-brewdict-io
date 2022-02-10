<?php

namespace App\Http\Resources;

use App\Http\Resources\Identifiers\RecipeResourceIdentifier;
use App\Http\Resources\Objects\RecipeResourceObject;
use App\Http\Resources\Objects\StyleResourceObject;
use App\Http\Resources\Objects\UserResourceObject;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "data" => new RecipeResourceObject($this),
            "links" => [
                "self" => $_ENV["APP_URL"] . "/api/" . RecipeResourceObject::TYPE,
            ],
            "included" => [
                new UserResourceObject($this->owner),
                $this->when(!is_null($this->parent), new RecipeResourceObject($this->parent)),
                new StyleResourceObject($this->style),
            ]
        ];
    }
}
