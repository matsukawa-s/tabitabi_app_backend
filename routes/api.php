<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'],function(){
    Route::post('index', 'SearchController@index');
    Route::post('search/{id}', 'SearchController@search');
    Route::post('favoritePlan', 'SearchController@update');
});

Route::group(['prefix' => 'auth'],function(){
    Route::post('/login', 'UserController@login');
    Route::post('/register', 'UserController@register');
    Route::get('/logout', 'UserController@logout')->middleware('auth:api');
});

Route::group(['middleware' => 'auth:api'],function(){
    Route::get('/get_user','UserController@getUser');
    //SpotController
    Route::get('/getAllFavorite','SpotController@getAllFavorite');
    Route::get('/getOneFavorite/{id}','SpotController@getOneFavorite');
    Route::post('/postFavoriteSpot','SpotController@postFavoriteSpot');
});

Route::group(['prefix' => 'plan'], function(){
    Route::get('get/{id}', 'PlanController@getPlanData');
    Route::post('store', 'PlanController@addPlanData');
    Route::post('store/image', 'PlanController@uploadImage');
    Route::post('update/date', 'PlanController@updatePlanDateTime');
});

Route::group(['prefix' => 'itinerary'], function(){
    Route::get('get/{id}', 'ItineraryController@getItineraryData');
    Route::post('store', 'ItineraryController@addItineraryData'); 
    Route::post('get/spot', 'ItinerarySpotController@getItinerarySpotData');
    Route::post('get/traffic', 'ItineraryTrafficController@getItineraryTrafficData');
    Route::post('get/note', 'ItineraryNoteController@getItineraryNoteData');
});

Route::group(['prefix' => 'spot'], function(){
    Route::post('store', 'SpotController@addSpotData');
});

Route::group(['prefix' => 'user','middleware' => 'auth:api'], function(){
    Route::post('profileSave', 'UserController@userProfileSave');
});
Route::group(['prefix' => 'tag'], function(){
    Route::get('get', 'TagController@getTag');
    Route::get('get/{name}', 'TagController@searchTag');
    Route::post('store', 'TagController@addTag');
});


