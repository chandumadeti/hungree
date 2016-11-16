<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    //
    protected $fillable = [
        'name', 'location_id', 'cover_photo', 'cuisine', 'amenities', 'type', 'phone_no', 'avg_cost_for_two', 'operation_hours', 'short_name'
    ];


    public function dishes()
    {
        return $this->hasMany('App\Entities\Dish');
    }

    public function locations()
    {
        return $this->hasMany('App\Entities\Location', 'location_id');
    }

    public function amenities()
    {
        return $this->hasMany('App\Entities\Amenity');
    }
}
