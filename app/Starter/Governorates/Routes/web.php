<?php

Route::group(['prefix' => 'governorates'], function () {
    Route::get('/', '\App\Starter\Governorates\Controllers\GovernorateController@index')->name('governorates');

//    Route::get('/create', '\App\Starter\Users\Controllers\UsersController@getCreate');
//    Route::post('/create', '\App\Starter\Users\Controllers\UsersController@postCreate');
//
    Route::get('/edit/{id}', '\App\Starter\Governorates\Controllers\GovernorateController@getEdit');
    Route::put('/edit/{id}', '\App\Starter\Governorates\Controllers\GovernorateController@postEdit')
        ->name('governorates.putGovernorate');

//    Route::get('/view/{id}', '\App\Starter\Users\Controllers\UsersController@getView')
//        ->name('users.view');
//
    Route::delete('/delete/{id}', '\App\Starter\Governorates\Controllers\GovernorateController@getDelete')
        ->name('governorates.delete');

//    Route::get('/export', '\App\Starter\Users\Controllers\UsersController@getExport');
});
