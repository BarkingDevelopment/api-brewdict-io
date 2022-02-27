<?php

namespace App\Http\Resources;

use App\Http\Resources\Objects\ProbeResourceObject;
use App\Http\Resources\Objects\ProbeStateResourceObject;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ProbeStateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return new ProbeStateResourceObject($this);
    }

    /**
     * @inheritDoc
     */
    public function with($request)
    {
        return [
            "included" => array_merge(
                new ProbeResourceObject($this->probe()),
            )
        ];
    }
}
