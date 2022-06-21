<?php

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', '\App\Starter\Categories\Controllers\CategoryController@index')->name('categories');

    Route::get('/{year}/question/create', '\App\Starter\Categories\Controllers\CategoryController@getCreate')->name('questions.create');
    Route::post('/{year}/question/create', '\App\Starter\Categories\Controllers\CategoryController@postCreate')->name('questions.store');;

    Route::get('/question/edit/{id}', '\App\Starter\Categories\Controllers\CategoryController@getEdit');
    Route::put('/question/edit/{id}', '\App\Starter\Categories\Controllers\CategoryController@postEdit')
        ->name('putCategories');

    Route::get('/question/view/{id}', '\App\Starter\Categories\Controllers\CategoryController@getView')
        ->name('view');

    Route::get('/{slug}/years', '\App\Starter\Categories\Controllers\CategoryController@years')
        ->name('years');

    Route::get('/{cat_id}/{year_id}/questions', '\App\Starter\Categories\Controllers\CategoryController@questions')
        ->name('questions');

    Route::delete('/delete/{id}', '\App\Starter\Categories\Controllers\CategoryController@getDelete')
        ->name('delete');
});
