<?php

Route::group(['prefix' => 'policies'], function () {
    Route::get('/', '\App\Starter\Policy\Controllers\PolicyController@index')->name('policies');

//    Route::get('/create', '\App\Starter\Policy\Controllers\PolicyController@getCreate');
//    Route::post('/create', '\App\Starter\Policy\Controllers\PolicyController@postCreate');
//
    Route::get('/edit/{id}', '\App\Starter\Policy\Controllers\PolicyController@getEdit');
    Route::put('/edit/{id}', '\App\Starter\Policy\Controllers\PolicyController@postEdit')
        ->name('policy.putUser');

//
//    Route::delete('/delete/{id}', '\App\Starter\Policy\Controllers\PolicyController@getDelete')
//        ->name('policy.delete');
});
