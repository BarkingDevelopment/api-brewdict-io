<?php

namespace App\Http\Resources\Objects;

use App\Http\Resources\Identifiers\StyleResourceIdentifierCollection;
use Illuminate\Http\Request;

class StyleCategoryResourceObject extends ResourceObject
{
    const TYPE = "style_category";

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
                "name" => $this->name,
                "description" => $this->description,
                "number" => $this->number,
                "style_guide" => $this->style_guide,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
            ],
            "relationship" => [
                new StyleResourceIdentifierCollection($this->styles()),
            ],
        ];
    }
}
