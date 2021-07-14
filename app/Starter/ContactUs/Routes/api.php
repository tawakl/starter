<?php
Route::group(['prefix' => 'ContactUs'], function () {
    Route::post('/create', '\App\Starter\ContactUs\Controllers\api\ContactUsController@store')->name('ContactUs');

});
