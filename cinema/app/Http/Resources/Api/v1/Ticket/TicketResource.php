<?php

namespace App\Http\Resources\Api\v1\Ticket;


use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'film_name' => $this->film->name,
            'start_date' => $this->film->start_date,
            'chair_number' => $this->chair->id,
        ];
    }
}
