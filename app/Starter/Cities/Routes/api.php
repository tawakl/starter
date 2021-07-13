<?php

Route::group(['prefix' => 'cities'], function () {
    Route::get('/', '\App\Starter\Cities\Controllers\api\CityController@index')->name('cities');

});
