<?php

Route::group(['prefix' => 'governorates'], function () {
    Route::get('/', '\App\Starter\Governorates\Controllers\GovernorateController@index')->name('governorates');

//    Route::get('/create', '\App\Starter\Users\Controllers\UsersController@getCreate');
//    Route::post('/create', '\App\Starter\Users\Controllers\UsersController@postCreate');
//
//    Route::get('/edit/{id}', '\App\Starter\Users\Controllers\UsersController@getEdit');
//    Route::put('/edit/{id}', '\App\Starter\Users\Controllers\UsersController@postEdit')
//        ->name('users.putUser');
//
//    Route::get('/view/{id}', '\App\Starter\Users\Controllers\UsersController@getView')
//        ->name('users.view');
//
//    Route::delete('/delete/{id}', '\App\Starter\Users\Controllers\UsersController@getDelete')
//        ->name('users.delete');
//
//    Route::get('/export', '\App\Starter\Users\Controllers\UsersController@getExport');
});
