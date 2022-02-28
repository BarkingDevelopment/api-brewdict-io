<?php

namespace App\Http\Resources\Objects;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Passport\Passport;

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
            "token_type" => "Bearer",
            "token" => $this->accessToken,
        ];
    }
}
