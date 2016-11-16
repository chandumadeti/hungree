<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    protected $fillable = [
        'name', 'description', 'icon', 'is_popular'
    ];


}
