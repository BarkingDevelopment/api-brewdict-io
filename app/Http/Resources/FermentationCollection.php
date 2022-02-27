<?php

namespace App\Http\Resources;

use App\Http\Resources\Objects\FermentationResourceObject;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class FermentationCollection extends ResourceCollection
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
            "data" => FermentationResourceObject::collection($this->collection),
            "links" => [
                "self" => $_ENV["APP_URL"] . "/api/" . FermentationResourceObject::TYPE,
            ],
        ];
    }

}
