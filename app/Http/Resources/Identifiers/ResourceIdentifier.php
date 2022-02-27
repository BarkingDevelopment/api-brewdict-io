<?php

namespace App\Http\Resources\Identifiers;

use Illuminate\Http\Request;

trait ResourceIdentifier
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "type" => self::$TYPE,
            "id" => $this->id,
        ];
    }
}
