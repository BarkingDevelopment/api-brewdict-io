<?php

namespace App\Http\Resources\Objects;

use App\Http\Resources\Identifiers\FermentationResourceIdentifierCollection;
use App\Http\Resources\Identifiers\ProbeResourceIdentifierCollection;
use App\Http\Resources\Identifiers\RecipeResourceIdentifierCollection;
use Illuminate\Http\Request;

class UserResourceObject extends ResourceObject
{
    const TYPE = "user";

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
                "username" => $this->username,
                "email" => $this->email,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
            ],
            "relationship" => [
                new RecipeResourceIdentifierCollection($this->recipes()),
                new FermentationResourceIdentifierCollection($this->fermentations()),
                new ProbeResourceIdentifierCollection($this->probes()),
            ],
        ];
    }
}
