<?php

Route::group(['prefix' => 'contact_us'], function () {
    Route::get('/', '\App\Starter\ContactUs\Controllers\ContactUsController@index')->name('ContactUs');
    Route::get('/view/{id}', '\App\Starter\ContactUs\Controllers\ContactUsController@getView');
    Route::delete('/delete/{id}', '\App\Starter\ContactUs\Controllers\ContactUsController@getDelete')
        ->name('contactUs.delete');
});
