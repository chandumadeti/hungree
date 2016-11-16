<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Response\JSendResponse;
use App\Entities\Amenity;
use Auth;
use JWTAuth;
use stdClass;
use App\Http\Requests;

class AmenitiesController extends Controller
{
    public function create()
    {

    	$input = Input::all();
    	$validator = Validator::make($input, [
            'name' => 'required',
            'icon' => 'required'
        ]);
        if ($validator->fails()) {
  			  $fail = JSendResponse::fail(['message' => 'Validaion error', 'errors' => $validator->messages()]);
        	return $fail;
       	}
        
        $created = $amenity = new Amenity;
       	$amenity->name = Input::get('name');
        $amenity->description = Input::get('description');
        $amenity->icon = Input::get('icon');
        $amenity->is_popular = Input::get('is_popular');
        $amenity->save();
        if($created){
        	$success = JSendResponse::success(['message' => "New Amenity has been created", 'id' => $created->id]);
          return $success;
        }else{
          $message = "Amenity could not be created";
          return response($message, 401);
        }
    }


    public function update($id)
    {
        $amenity = Amenity::where('id', $id)->first();
        $amenity->name = Input::get('name');
        $amenity->description = Input::get('description');
        $amenity->icon = Input::get('icon');
        $amenity->is_popular = Input::get('is_popular');
        $amenity->update();
        $amenityupdated = $amenity->save();
        if($amenityupdated){
            $message = JSendResponse::success(['message' => 'Amenity Successfully Updated', 'input'=>Input::all()]);
            return $message;

        }else{
            $message = JSendResponse::fail(['message' => 'Amenity Couldnt be Updated']);
            return response($message, 401);

        }
    }

    public function getAmenityByID($id) 
    {
      $amenity = Amenity::find($id);
      $jsend = JSendResponse::success($amenity->toArray());
      return $jsend;
    }

    public function getAllAmenities()
    {

      $amenities = Amenity::all();
      $jsend = JSendResponse::success($amenities->toArray());
      return $jsend;
    }

    public function delete($id)
 	{
     $amenity = Amenity::where('id', $id)->first();
     if($amenity)
     {
           $amenitydeleted = $amenity->delete($id);
       if($amenitydeleted)
       {
          $success = JSendResponse::success(['message' => 'amenity deleted successfully']);
       }
       return $success;
     }
    }
}

