<?php

Route::group(['prefix' => 'cities'], function () {
    Route::get('/', '\App\Starter\Cities\Controllers\CityController@index')->name('cities');

    Route::get('/create', '\App\Starter\Cities\Controllers\CityController@getCreate');
    Route::post('/create', '\App\Starter\Cities\Controllers\CityController@postCreate');

    Route::get('/edit/{id}', '\App\Starter\Cities\Controllers\CityController@getEdit');
    Route::put('/edit/{id}', '\App\Starter\Cities\Controllers\CityController@postEdit')
        ->name('cities.putCity');

    Route::get('/view/{id}', '\App\Starter\Cities\Controllers\CityController@getView')
        ->name('cities.view');

    Route::delete('/delete/{id}', '\App\Starter\Cities\Controllers\CityController@getDelete')
        ->name('cities.delete');

    Route::get('/export', '\App\Starter\Cities\Controllers\CityController@getExport');
});
