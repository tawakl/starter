<?php

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', '\App\Starter\Categories\Controllers\api\CategoryController@index')->name('categories');

});
