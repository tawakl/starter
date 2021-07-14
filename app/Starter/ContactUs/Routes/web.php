<?php

Route::group(['prefix' => 'contact_us'], function () {
    Route::get('/', '\App\Starter\ContactUs\Controllers\ContactUsController@index')->name('ContactUs');
    Route::get('/view/{id}', '\App\Starter\ContactUs\Controllers\ContactUsController@getView');

//    Route::get('/create', '\App\Starter\ContactUs\Controllers\ContactUsController@getCreate');
//    Route::post('/create', '\App\Starter\ContactUs\Controllers\ContactUsController@postCreate');
//
//    Route::get('/edit/{id}', '\App\Starter\ContactUs\Controllers\ContactUsController@getEdit');
//    Route::put('/edit/{id}', '\App\Starter\ContactUs\Controllers\ContactUsController@postEdit')
//        ->name('ContactUs.putUser');

//
//    Route::delete('/delete/{id}', '\App\Starter\ContactUs\Controllers\ContactUsController@getDelete')
//        ->name('ContactUs.delete');
});
