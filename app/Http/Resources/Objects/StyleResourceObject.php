<?php

namespace App\Http\Resources\Objects;

use App\Http\Resources\Identifiers\StyleCategoryResourceIdentifier;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StyleResourceObject extends JsonResource
{
    const TYPE = "styles";

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
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
            ],
            "relationship" => [
                StyleCategoryResourceObject::TYPE => [
                    "data" => new StyleCategoryResourceIdentifier($this->styleCategory),
                    "links" => [
                        "self" => $_ENV["APP_URL"] . "/api/" . StyleCategoryResourceObject::TYPE . "/" . $this->styleCategory->id,
                    ],
                ],
            ],
            "links" => [
                "self" => $SELF_LINK,
            ],
        ];
    }
}
