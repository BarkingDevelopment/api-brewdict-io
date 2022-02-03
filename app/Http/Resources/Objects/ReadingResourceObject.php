<?php

namespace App\Http\Resources\Objects;

use App\Http\Resources\Identifiers\FermentationResourceIdentifier;
use App\Http\Resources\Identifiers\ProbeResourceIdentifier;
use Illuminate\Http\Request;

class ReadingResourceObject extends ResourceObject
{
    const TYPE = "reading";

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
                "type" => $this->type,
                "value" => $this->value,
                "units" => $this->units,
                "recorded_at" => $this->recorded_at,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
            ],
            "relationship" => [
                "fermentation" => [
                    "data" => new FermentationResourceIdentifier($this->fermentation()),
                ],
                "probe" => [
                    "data" => new ProbeResourceIdentifier($this->probe()),
                ],
            ],
        ];
    }
}
