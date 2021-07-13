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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('register', '\App\Starter\Users\Controllers\Api\AuthApiController@register');
Route::post('login', '\App\Starter\Users\Controllers\Api\AuthApiController@login');
Route::get('logout', '\App\Starter\Users\Controllers\Api\AuthApiController@logout');
Route::get('user', '\App\Starter\Users\Controllers\Api\AuthApiController@getAuthUser');


    require base_path('app/Starter/Cities/Routes/api.php');
    require base_path('app/Starter/Governorates/Routes/api.php');

