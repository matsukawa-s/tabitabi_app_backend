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
    Route::post('tagSearch/{id}', 'SearchController@tagSearch');
    Route::post('favoritePlan', 'SearchController@update');
    Route::get('tag', 'SearchController@indexTag');
    Route::get('tag/{key}', 'SearchController@searchTag');
});

Route::group(['prefix' => 'auth'],function(){
    Route::post('/login', 'UserController@login');
    Route::post('/register', 'UserController@register');
    Route::get('/logout', 'UserController@logout')->middleware('auth:api');
});

Route::group(['middleware' => 'auth:api'],function(){
    //SpotController
    Route::get('/getAllFavorite','SpotController@getAllFavorite');
    Route::get('/getOneFavorite/{id}','SpotController@getOneFavorite');
    Route::post('/postFavoriteSpot','SpotController@postFavoriteSpot');
});

Route::group(['prefix' => 'plan','middleware' => 'auth:api'], function(){
    Route::get('get/{id}', 'PlanController@getPlanData');
    Route::get('delete/{id}', 'PlanController@deletePlan');
    Route::post('store', 'PlanController@addPlanData');
    Route::post('info/update', 'PlanController@updatePlan');
    Route::post('update/open', 'PlanController@updateOpenPlan');
    Route::post('update/date', 'PlanController@updatePlanDateTime');
    Route::get('favorite/get','PlanController@getFavoritePlans');
    Route::post('favorite/delete','PlanController@deleteFavoritePlan');
    Route::get('copy/{id}', 'PlanController@copyPlan');
    Route::post('favorite/store','PlanController@favoriteStore');
    Route::post('favorite/delete','PlanController@favoriteDelete');

});

Route::group(['prefix' => 'photo','middleware' => 'auth:api'], function(){
    Route::get('get/{id}', 'PhotoController@getPhotos');
    Route::post('store', 'PhotoController@addPhotos');
    Route::get('delete/{id}', 'PhotoController@deletePhoto');
});


Route::group(['prefix' => 'itinerary','middleware' => 'auth:api'], function(){
    Route::get('get/{id}', 'ItineraryController@getItineraryData');
    Route::post('store', 'ItineraryController@addItineraryData');
    Route::get('delete/{itiId}/{dataType}', 'ItineraryController@deleteItineraryData');  
    Route::get('day/delete/{date}', 'ItineraryController@deleteDateItineraryData');
    Route::get('rearrange/{itiId}/{order}/{spotOrder}/{dataType}', 'ItineraryController@rearrangeItineraryData');
    Route::post('get/spot', 'ItinerarySpotController@getItinerarySpotData');
    Route::post('update/spot/date', 'ItinerarySpotController@updateDate');
    Route::post('get/traffic', 'ItineraryTrafficController@getItineraryTrafficData');
    Route::post('update/traffic/time', 'ItineraryTrafficController@updateTime');
    Route::post('get/note', 'ItineraryNoteController@getItineraryNoteData');
});

Route::group(['prefix' => 'planspot'], function(){
    Route::get('get/{id}', 'PlanSpotController@getPlanSpotData');
    Route::post('store', 'PlanSpotController@addPlanSpotData');
    Route::get('delete/{id}', 'PlanSpotController@deletePlanSpotData');
});

Route::group(['prefix' => 'spot'], function(){
    Route::get('get/types','SpotController@getSpotTypes');
    Route::post('store', 'SpotController@addSpotData');
    Route::post('getPlanContainingSpot', 'SpotController@getPlanContainingSpot');
});

Route::group(['prefix' => 'user','middleware' => 'auth:api'], function(){
    Route::get('/get_user','UserController@getUser');
    Route::post('profileSave', 'UserController@userProfileSave');
    // Route::get('getPlans','UserController@getPlans');
});

Route::group(['prefix' => 'top','middleware' => 'auth:api'], function(){
    Route::get('/','TopController@index');
});

Route::group(['prefix' => 'tag'], function(){
    Route::get('get', 'TagController@getTag');
    Route::get('get/{name}', 'TagController@searchTag');
    Route::post('store', 'TagController@addTag');
});

Route::group(['prefix' => 'member','middleware' => 'auth:api'], function(){
    Route::get('search/{code}','MemberController@searchJoinPlan');
    Route::post('store', 'MemberController@joinPlan');
});


