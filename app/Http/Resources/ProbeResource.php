<?php

namespace App\Http\Resources;

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
        return [
            "id" => $this->id,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "name" => $this->name,
            "colour" => $this->colour,
            "chip_id" => $this->chip_id,
            "mac" => $this->mac,
            "owner" => new UserResource($this->owner),
            "current_fermentation" => new FermentationObject($this->currentFermentation),
            "statistics" => new ProbeStateCollection($this->statistics),
            "readings" => new ReadingCollection($this->readings)
        ];
    }
}
