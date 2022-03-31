<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class StyleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return  [
            "id" => $this->id,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "name" => $this->name,
            "style_category" => new StyleCategoryObject($this->styleCategory),
            "style_letter" => $this->style_letter,
            "type" => $this->type,
            "og_min" => $this->og_min,
            "og_max" => $this->og_max,
            "fg_min" => $this->fg_min,
            "fg_max" => $this->fg_max,
            "ibu_min" => $this->ibu_min,
            "ibu_max" => $this->ibu_max,
            "srm_min" => $this->srm_min,
            "srm_max" => $this->srm_max,
            "notes" => $this->notes,
        ];
    }
}
