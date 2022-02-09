<?php

namespace App\Http\Resources\Objects;

use App\Http\Resources\Identifiers\StyleResourceIdentifier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StyleCategoryResourceObject extends JsonResource
{
    const TYPE = "style_categories";

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
                "name" => $this->name,
                "description" => $this->description,
                "number" => $this->number,
                "style_guide" => $this->style_guide,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
            ],
            "relationship" => [
                StyleResourceObject::TYPE => [
                    "data" => StyleResourceIdentifier::collection($this->styles),
                    "links" => [
                        "related" => $SELF_LINK . "/" . StyleResourceObject::TYPE,
                    ],
                ],
            ],
            "links" => [
                "self" => $SELF_LINK,
            ],
        ];
    }
}
