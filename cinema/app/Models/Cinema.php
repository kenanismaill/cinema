<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'city_id',
    ];


    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function films()
    {
        return $this->belongsToMany(Film::class);
    }
}
