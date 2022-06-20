<?php

Route::group(['prefix' => 'years'], function () {


    Route::get('/{slug}/years', '\App\Starter\Years\Controllers\YearController@years')
        ->name('years');

});
