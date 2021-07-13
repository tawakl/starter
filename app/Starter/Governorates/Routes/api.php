<?php

Route::group(['prefix' => 'governorates'], function () {
    Route::get('/', '\App\Starter\Governorates\Controllers\api\GovernorateController@index')->name('governorates');

});
