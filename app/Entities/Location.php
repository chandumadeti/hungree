<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name'
    ];
    public function restaurants()
    {
        return $this->hasMany('App\Entities\Restaurant', 'location_id');
    }


}
