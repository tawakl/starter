<?php

Route::group(['prefix' => 'policies'], function () {
    Route::get('/', '\App\Starter\Policy\Controllers\api\PolicyController@index')->name('Policy');

});
