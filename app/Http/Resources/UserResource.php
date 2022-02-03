<?php

namespace App\Http\Resources;

use App\Http\Resources\Objects\FermentationResourceObject;
use App\Http\Resources\Objects\ProbeResourceObject;
use App\Http\Resources\Objects\RecipeResourceObject;
use App\Http\Resources\Objects\UserResourceObject;
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
        return new UserResourceObject($this);
    }

    /**
     * @inheritDoc
     */
    public function with($request)
    {
        return [
            "included" => array_merge(
                RecipeResourceObject::collection($this->recipes()),
                FermentationResourceObject::collection($this->fermentations()),
                ProbeResourceObject::collection($this->probes()),
            ),
        ];
    }
}
