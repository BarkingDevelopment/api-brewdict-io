<?php

namespace App\Http\Resources;

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
        return [
            "id" => $this->id,
            "recorded_at" => $this->recorded_at,
            "probe" => new ProbeObject($this->probe),
            "battery" => $this->battery,
            "signal_strength" => $this->signal_strength,
        ];
    }
}
