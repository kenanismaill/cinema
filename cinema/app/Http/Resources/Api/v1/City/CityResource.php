<?php

namespace App\Http\Resources\Api\v1\City;

use App\Http\Resources\Api\v1\Cinema\CinemaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'cinema' => CinemaResource::collection($this->whenLoaded('cinemas')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
