<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
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
            "username" => $this->username,
            "email" => $this->email,
            "recipes" => RecipeObject::collection($this->recipes),
            "fermentations" => FermentationObject::collection($this->fermentations),
            "probes" => ProbeObject::collection($this->probes)
        ];
    }
}
