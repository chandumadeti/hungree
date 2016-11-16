<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Restaurant;
use App\Entities\Dish;

class Dish extends Model
{
    //
    protected $fillable = [
        'name', 'category', 'veggie'
    ];


    public function restaurant()
    {
        return $this->belongsTo('App\Entities\Restaurant');
    }


    public static function getDishesByCategory($category)
    {
        print $category;
        $dishes = Dish::where('category', $category)->get();
        return $dishes;
    }
    
}


