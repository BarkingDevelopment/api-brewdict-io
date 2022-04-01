<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class RecipeObject extends JsonResource
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
            "owner" => new UserObject($this->owner),
            "name" => $this->name,
            "description" => $this->description,
            "style" => new StyleResource($this->style),
            "abv" => $this->abv,
            "ibu" => $this->ibu,
            "srm" => $this->srm
        ];
    }
}
