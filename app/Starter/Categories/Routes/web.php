<?php

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', '\App\Starter\Categories\Controllers\CategoryController@index')->name('categories');

    Route::get('/{year}/question/create', '\App\Starter\Categories\Controllers\CategoryController@getCreate')->name('questions.create');
    Route::post('/{year}/question/create', '\App\Starter\Categories\Controllers\CategoryController@postCreate')->name('questions.store');;

    Route::get('/{year}/question/edit/{id}', '\App\Starter\Categories\Controllers\CategoryController@getEdit')->name('questions.edit');
    Route::put('/{year}/question/edit/{id}', '\App\Starter\Categories\Controllers\CategoryController@postEdit')
        ->name('questions.update');

    Route::get('/question/view/{id}', '\App\Starter\Categories\Controllers\CategoryController@getView')
        ->name('view');

    Route::get('/{slug}/years', '\App\Starter\Categories\Controllers\CategoryController@years')
        ->name('years');

    Route::get('/{cat_id}/{year_id}/questions', '\App\Starter\Categories\Controllers\CategoryController@questions')
        ->name('questions');

    Route::delete('{year}/question/delete/{id}', '\App\Starter\Categories\Controllers\CategoryController@getDelete')
        ->name('delete');
});
