<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingChair extends Model
{
    use HasFactory;

    protected $fillable = [
        'chair_id',
        'user_id',
        'film_id',
    ];
}
