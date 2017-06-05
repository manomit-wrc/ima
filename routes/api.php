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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/home-content','PageController@home_content');
Route::post('/registration','PageController@registration');
Route::post('/login', 'PageController@login');
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/doctors', 'PageController@getAuthUser');
    Route::get('/state-list', 'PageController@get_state_list');
    Route::post('/update-profile', 'PageController@update_profile');
    Route::post('/update-profile-photo','PageController@update_profile_photo');
});