<?php

namespace App\Http\Resources\Objects;

use App\Http\Resources\Identifiers\ProbeResourceIdentifier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProbeStateResourceObject extends JsonResource
{
    const TYPE = "probe_states";

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $SELF_LINK = $_ENV["APP_URL"] . "/api/" . self::TYPE . "/" . $this->id;

        return [
            "type" => self::TYPE,
            "id" => $this->id,
            "attributes" => [
                "battery" => $this->battery,
                "signal_strength" => $this->signal_strength,
                "recorded_at" => $this->recorded_at,
            ],
            "relationship" => [
                ProbeResourceObject::TYPE => [
                    "data" => new ProbeResourceIdentifier($this->probe),
                    "links" => [
                        "self" => $_ENV["APP_URL"] . "/api/" . ProbeResourceObject::TYPE . "/" . $this->probe->id,
                    ],
                ],
            ],
            "links" => [
                "self" => $SELF_LINK,
            ],
        ];
    }
}
