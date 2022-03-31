<?php

namespace App\Http\Resources;

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
        return [
            "id" => $this->id,
            "recorded_at" => $this->recorded_at,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "fermentation" => new FermentationObject($this->fermentation),
            "probe" => new ProbeObject($this->probe),
            "type" => $this->type,
            "value" => $this->value,
            "units" => $this->units,
        ];
    }
}
