<?php

Route::group(['prefix' => 'questions'], function () {

    Route::get('/question/create', '\App\Starter\Questions\Controllers\QuestionController@getCreate');
    Route::post('/question/create', '\App\Starter\Questions\Controllers\QuestionController@postCreate');

    Route::get('/question/edit/{id}', '\App\Starter\Questions\Controllers\QuestionController@getEdit');
    Route::put('/question/edit/{id}', '\App\Starter\Questions\Controllers\QuestionController@postEdit')
        ->name('putCategories');


    Route::get('/{cat_id}/{year_id}/questions', '\App\Starter\Questions\Controllers\QuestionController@questions')
        ->name('questions');

    Route::delete('/delete/{id}', '\App\Starter\Questions\Controllers\QuestionController@getDelete')
        ->name('delete');

//    Route::get('/export', '\App\Starter\Users\Controllers\UsersController@getExport');
});
