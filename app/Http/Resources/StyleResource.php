<?php

namespace App\Http\Resources;

use App\Http\Resources\Objects\StyleCategoryResourceObject;
use App\Http\Resources\Objects\StyleResourceObject;
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
        return new StyleResourceObject($this);
    }

    /**
     * @inheritDoc
     */
    public function with($request)
    {
        return [
            "included" => array_merge(
                new StyleCategoryResourceObject($this->styleCategory()),
            ),
        ];
    }
}
