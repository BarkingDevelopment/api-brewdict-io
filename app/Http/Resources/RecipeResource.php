<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class RecipeResource extends JsonResource
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
            "owner" => new UserResource($this->owner),
            "name" => $this->name,
            "description" => $this->description,
            "inspiration" => !is_null($this->parent) ? new RecipeObject($this->parent) : "null",
            "style" => new StyleResource($this->style),
            "og" => $this->og,
            "fg" => $this->fg,
            "ibu" => $this->ibu,
            "srm" => $this->srm
        ];
    }
}
