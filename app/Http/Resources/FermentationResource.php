<?php

namespace App\Http\Resources;

use App\Models\User;
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
        return [
            "id" => $this->id,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "recipe" => new RecipeObject($this->recipe),
            "brewer" => new UserObject($this->brewer),
            "equipment" => !is_null($this->equipment) ? new EquipmentResource($this->equipment) : null,
            "started_at" => $this->started_at,
            "og" => $this->og,
            "completed" => boolval($this->completed),
            "probes" => ProbeObject::collection($this->probes),
            "readings" => ReadingObject::collection($this->readings)
        ];
    }
}
