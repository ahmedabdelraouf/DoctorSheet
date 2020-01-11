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

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

//Route::group(['middleware' => 'auth:api'], function() {
//Categories APIS
Route::post('categories', 'API\CategoryController@index')->name("categories.list");
Route::post('getCategoryInfo', 'API\CategoryController@getCategoryInfo')->name("category.show");
Route::post('storCategory', 'API\CategoryController@store')->name("category.store");
Route::post('updateCategory', 'API\CategoryController@update')->name("category.update");
Route::post('deleteCategory', 'API\CategoryController@delete')->name("category.delete");

//workPlaces APIS
Route::post('workPlaces', 'API\WorkPlaceController@workPlaces')->name("workPlaces.list");
Route::post('getWorkPlaceInfo', 'API\WorkPlaceController@getWorkPlaceInfo')->name("workPlace.getWorkPlaceInfo");
Route::post('storeWorkPlace', 'API\WorkPlaceController@store')->name("workPlace.store");
Route::post('updateWorkPlace', 'API\WorkPlaceController@update')->name("workPlace.update");
Route::post('deleteWorkPlace', 'API\WorkPlaceController@delete')->name("workPlace.delete");

//});
