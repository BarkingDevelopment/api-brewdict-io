<?php

namespace App\Http\Resources;

use App\Http\Resources\Objects\EquipmentResourceObject;
use App\Http\Resources\Objects\FermentationResourceObject;
use App\Http\Resources\Objects\ProbeResourceObject;
use App\Http\Resources\Objects\ReadingResourceObject;
use App\Http\Resources\Objects\RecipeResourceObject;
use App\Http\Resources\Objects\UserResourceObject;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class FermentationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return new FermentationResourceObject($this);
    }

    /**
     * @inheritDoc
     */
    public function with($request)
    {
        return array_merge(
            new RecipeResourceObject($this->recipe()),
            new UserResourceObject($this->brewer()),
            new EquipmentResourceObject($this->equipment()),
            ProbeResourceObject::collection($this->probes()),
            ReadingResourceObject::collection($this->readings()),
        );
    }
}
