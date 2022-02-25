<?php

namespace App\Http\Resources\Api\v1\Cinema;

use App\Http\Resources\Api\v1\Film\FilmResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CinemaResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'films' => FilmResource::collection($this->whenLoaded('films')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
