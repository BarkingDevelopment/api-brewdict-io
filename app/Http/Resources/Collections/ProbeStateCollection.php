<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\Objects\ProbeStateResourceObject;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class ProbeStateCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return ProbeStateResourceObject::collection($this->collection);
    }

    /**
     * @inheritDoc
     *
     *  TODO Need to add link urls.
     */
    public function with($request)
    {
        return [
            "links" => [
                "self" => "",
                "related" => "",
            ],
        ];
    }
}
