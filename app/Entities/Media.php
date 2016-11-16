<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'name', 'type', 'url'
    ];

}
