<?php

Route::group(['prefix' => 'policies'], function () {
    Route::get('edit/', '\App\Starter\Policy\Controllers\PolicyController@getEdit')->name('Policy.get.edit');
    Route::put('edit/', '\App\Starter\Policy\Controllers\PolicyController@postEdit')->name('Policy.post.edit');

});
