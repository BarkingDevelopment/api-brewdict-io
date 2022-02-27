<?php

namespace App\Http\Resources;

use App\Http\Resources\Objects\FermentationResourceObject;
use App\Http\Resources\Objects\ProbeResourceObject;
use App\Http\Resources\Objects\ProbeStateResourceObject;
use App\Http\Resources\Objects\UserResourceObject;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ProbeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return new ProbeResourceObject($this);
    }

    /**
     * @inheritDoc
     */
    public function with($request)
    {
        return [
            "included" => array_merge(
                new UserResourceObject($this->owner()),
                new ProbeStateResourceObject($this->status()),
                new FermentationResourceObject($this->currentFermentation()),
            )
        ];
    }
}
