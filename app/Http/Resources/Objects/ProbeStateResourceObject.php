<?php

namespace App\Http\Resources\Objects;

use App\Http\Resources\Identifiers\ProbeResourceIdentifier;
use Illuminate\Http\Request;

class ProbeStateResourceObject extends ResourceObject
{
    const TYPE = "probe_state";

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "type" => self::TYPE,
            "id" => $this->id,
            "attributes" => [
                "battery" => $this->battery,
                "signal_strength" => $this->signal_strength,
                "recorded_at" => $this->recorded_at,
            ],
            "relationship" => [
                "probe" => [
                    "data" => new ProbeResourceIdentifier($this->probe()),
                ],
            ],
        ];
    }
}
