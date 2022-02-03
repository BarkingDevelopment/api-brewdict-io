<?php

namespace App\Http\Resources;

use App\Http\Resources\Objects\FermentationResourceObject;
use App\Http\Resources\Objects\ProbeResourceObject;
use App\Http\Resources\Objects\ReadingResourceObject;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ReadingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return new ReadingResourceObject($this);
    }

    /**
     * @inheritDoc
     */
    public function with($request)
    {
        return array_merge(
            new FermentationResourceObject($this->fermentation()),
            new ProbeResourceObject($this->probe()),
        );
    }
}
