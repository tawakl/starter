<?php
/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */



    Route::group([], function () {
        Route::group(['prefix' => 'auth'], function () {
            require base_path('app/Starter/Users/Routes/auth.php');
        });

        Route::group(['middleware' => ['auth']], function () {
            require base_path('app/Starter/Users/Routes/web.php');
            require base_path('app/Starter/Users/Routes/roles.php');
            require base_path('app/Starter/Config/Routes/web.php');
            require base_path('app/Starter/Profile/Routes/web.php');
            require base_path('app/Starter/Cities/Routes/web.php');
            require base_path('app/Starter/Governorates/Routes/web.php');
            require base_path('app/Starter/Policy/Routes/web.php');
            require base_path('app/Starter/ContactUs/Routes/web.php');
            require base_path('app/Starter/Categories/Routes/web.php');
//            require base_path('app/Starter/Years/Routes/web.php');
//            require base_path('app/Starter/Questions/Routes/web.php');
            Route::get('/', '\App\Starter\Users\Controllers\UsersController@getIndex');
        });
});
