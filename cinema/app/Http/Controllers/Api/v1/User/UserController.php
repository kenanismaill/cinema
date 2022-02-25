<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Ticket\TicketResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function tickets(User $user)
    {

        $tickets = $user->tickets()->with(['film', 'chair'])->get();

        return TicketResource::collection($tickets);
    }
}
