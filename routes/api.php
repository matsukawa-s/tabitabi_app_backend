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

Route::get('index', 'SearchController@index');
Route::get('search/{id}', 'SearchController@search');
Route::post('favoritePlan', 'SearchController@update');

// Route::get('/search', 'SearchController@index');
// Route::get('/sample', function () {
//     return [1, 2, 3];
// });

Route::group(['prefix' => 'auth'],function(){
    Route::post('/login', 'UserController@login');
    Route::post('/register', 'UserController@register');
    Route::get('/logout', 'UserController@logout')->middleware('auth:api');
});