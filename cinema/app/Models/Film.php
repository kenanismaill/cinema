<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cinema_id',
        'start_date',
        'end_date',
        'duration',
        'type',
        'size',
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }


    public function cinema()
    {
      return $this->belongsToMany(Cinema::class);
    }

    public function empty_chairs()
    {
        return $this->hasMany(Chair::class)->where('status','=', false);
    }

}
