<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(array('prefix' => 'api/v1', 'middleware' => ['web']), function()
{
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
    header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

    //Restaurant APIS
    Route::post('/restaurant', 'RestaurantsController@create');
    Route::post('/restaurant/{id}', 'RestaurantsController@update');
    Route::get('/restaurant/{id}', 'RestaurantsController@getRestaurantByID');
    Route::get('/restaurants', 'RestaurantsController@getAllRestaurants');
    Route::delete('/restaurant/{id}', 'RestaurantsController@delete');
    Route::get('/restaurant/{location_id}', 'RestaurantsController@getRestaurantsInLocation');
    Route::get('/buffetrestaurants', 'RestaurantsController@getRestaurantsWithBuffet');
    Route::get('/restaurants/{type}/{value}', 'RestaurantsController@filterRestaurants');

    
    //Amenities APIS
    Route::post('/amenity', 'AmenitiesController@create');
    Route::post('/amenity/{id}', 'AmenitiesController@update');
    Route::get('/amenity/{id}', 'AmenitiesController@getAmenityByID');
    Route::get('/amenities', 'AmenitiesController@getAllAmenities');
    Route::delete('/amenity/{id}', 'AmenitiesController@delete');
    

    //Secure Routes
    Route::group(['middleware' => 'jwt-auth'], function () {
        
    });

});
