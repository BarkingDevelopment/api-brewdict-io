<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\Objects\RecipeResourceObject;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class RecipeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "data" => RecipeResourceObject::collection($this->collection),
            "links" => [
                "self" => $_ENV["APP_URL"] . "/api/" . RecipeResourceObject::TYPE,
            ],
        ];
    }
}
