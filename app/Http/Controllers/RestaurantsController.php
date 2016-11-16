<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Response\JSendResponse;
use App\Entities\Restaurant;
use Auth;
use JWTAuth;
use stdClass;
use App\Http\Requests;

class RestaurantsController extends Controller
{
    //Create a new restaurant

    public function create()
    {

    	$input = Input::all();
    	$validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
            'location_id' => 'required',
            'cover_photo' => 'required',
            'cuisine' => 'required',
            'amenities' => 'required',
            'type' => 'required',
            'phone_no' => 'required',
            'avg_cost_for_two' => 'required',
            'operation_hours' => 'required',
            'short_name' =>'required'
            
        ]);
        if ($validator->fails()) {
  			  $fail = JSendResponse::fail(['message' => 'Validaion error', 'errors' => $validator->messages()]);
        	return $fail;
       	}
        
        $created = $restaurant = new Restaurant;
       	$restaurant->name = Input::get('name');
        $restaurant->description = Input::get('description');
        $restaurant->location_id = Input::get('location_id');
        $restaurant->cover_photo = Input::get('media_id');
        $restaurant->ambience_photo = Input::get('media_id');
        $restaurant->cuisine = Input::get('cuisine');
        $restaurant->amenities = Input::get('amenity_id');
        $restaurant->video = Input::get('media_id');
        $restaurant->type = Input::get('type');
        $restaurant->phone_no = Input::get('phone_no');
        $restaurant->avg_cost_for_two = Input::get('avg_cost_for_two');
        $restaurant->operation_hours = Input::get('operation_hours');
        $restaurant->sunday_brunch = Input::get('sunday_brunch');
        $restaurant->buffet_details = Input::get('buffet_details');
        $restaurant->short_name = Input::get('short_name');
        $restaurant->save();
        if($created){
        	$success = JSendResponse::success(['message' => "New Restaurant has been created", 'id' => $created->id]);
          return $success;
        }else{
          $message = "Restaurant could not be created";
          return response($message, 401);
        }
    }


    public function update($id)
    {
        $restaurant = Restaurant::where('id', $id)->first();
        $restaurant->name = Input::get('name');
        $restaurant->description = Input::get('description');
        $restaurant->location_id = Input::get('location_id');
        $restaurant->cover_photo = Input::get('media_id');
        $restaurant->ambience_photo = Input::get('media_id');
        $restaurant->cuisine = Input::get('cuisine');
        $restaurant->amenities = Input::get('amenity_id');
        $restaurant->video = Input::get('media_id');
        $restaurant->type = Input::get('type');
        $restaurant->phone_no = Input::get('phone_no');
        $restaurant->avg_cost_for_two = Input::get('avg_cost_for_two');
        $restaurant->operation_hours = Input::get('operation_hours');
        $restaurant->sunday_brunch = Input::get('sunday_brunch');
        $restaurant->buffet_details = Input::get('buffet_details');
        $restaurant->short_name = Input::get('short_name');
        $restaurant->update();
        $restaurantupdated = $restaurant->save();
        if($restaurantupdated){
            $message = JSendResponse::success(['message' => 'Restaurant Successfully Updated', 'input'=>Input::all()]);
            return $message;

        }else{
            $message = JSendResponse::fail(['message' => 'Restaurant Couldnt be Updated']);
            return response($message, 401);

        }
    }

    public function getRestaurantByID($id) 
    {
      $restaurant = Restaurant::find($id);
      $jsend = JSendResponse::success($restaurant->toArray());
      return $jsend;
    }

    public function getAllRestaurants()
    {

      $restaurants = Restaurant::all();
      $jsend = JSendResponse::success($restaurants->toArray());
      return $jsend;
    }

    public function delete($id)
 	 {
     $restaurant = Restaurant::where('id', $id)->first();
     if($restaurant){
           $restaurantdeleted = $restaurant->delete($id);
       if($restaurantdeleted){
          $success = JSendResponse::success(['message' => 'restaurant deleted successfully']);
       }
       return $success;
     }
    }


    public function getRestaurantsInLocation($lat, $lng)
    {
      // Get restaurant location by lat , lng
      /*$restaurants = Restaurant::all();
      foreach( $restaurants as $restaurant){
          $location_id = $restaurant->location_id;
          $locations = $location::where()
      }
      if($restaurant){
        $locations = $restaurant->locations()->get();
        $jsend = JSendResponse::success($locations->toArray());
      }else{
        $message = JSendResponse::fail(['message' => 'Couldnt find location']);
        return response($message, 401);
      }
      return $jsend;*/
    }

    public function getRestaurantsWithBuffet()
    {
     // $restaurants = Restaurant::with($buffet_details)-get();
      // Get all restaurants where buffet_details is not empty
      $restaurant = Restaurant::where('buffet_details', '!=', '')->get();
      $jsend = JSendResponse::success($restaurant->toArray());  
        return $jsend;
    }

    public function filterRestaurants($type, $value)
    {
      
      $restaurants = Restaurant::where($type, $value)->get();
      $jsend = JSendResponse::success($restaurants->toArray());
        return $restaurants;
    }
}