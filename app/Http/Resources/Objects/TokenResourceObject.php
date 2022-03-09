<?php

namespace App\Http\Resources\Objects;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TokenResourceObject extends JsonResource
{
    const TYPE = "token";

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
                "token_type" => "Bearer",
                "token" => $this->accessToken,
            ]
        ];
    }
}
