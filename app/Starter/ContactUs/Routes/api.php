<?php

Route::group(['prefix' => 'ContactUs'], function () {
    Route::get('/', '\App\Starter\ContactUs\Controllers\api\ContactUsController@index')->name('ContactUs');

});
