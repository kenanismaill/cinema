<?php

namespace App\Http\Resources\Api\v1\Film;

use App\Http\Resources\Api\v1\Cinema\CinemaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FilmResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'type' => $this->type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'duration' => $this->duration,
            'empty_chairs' => $this->whenLoaded('empty_chairs'),
            'cinemas' => CinemaResource::collection($this->whenLoaded('cinema')),
            'images' => $this->whenLoaded('images'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
