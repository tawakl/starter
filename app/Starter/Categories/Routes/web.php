<?php

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', '\App\Starter\Categories\Controllers\CategoryController@index')->name('categories');

    Route::get('/question/create', '\App\Starter\Categories\Controllers\CategoryController@getCreate');
    Route::post('/question/create', '\App\Starter\Categories\Controllers\CategoryController@postCreate');

    Route::get('/question/edit/{id}', '\App\Starter\Categories\Controllers\CategoryController@getEdit');
    Route::put('/question/edit/{id}', '\App\Starter\Categories\Controllers\CategoryController@postEdit')
        ->name('putCategories');

    Route::get('/{slug}/years', '\App\Starter\Categories\Controllers\CategoryController@years')
        ->name('years');

    Route::get('/{cat_id}/{year_id}/questions', '\App\Starter\Categories\Controllers\CategoryController@questions')
        ->name('questions');

    Route::delete('/delete/{id}', '\App\Starter\Categories\Controllers\CategoryController@getDelete')
        ->name('delete');

//    Route::get('/export', '\App\Starter\Users\Controllers\UsersController@getExport');
});
