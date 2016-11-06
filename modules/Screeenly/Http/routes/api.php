<?php

Route::group(['prefix' => 'v1'], function() {

    Route::post('fullsize', 'v1\ScreenshotController@store')->middleware('auth:api');

});

Route::group(['prefix' => 'v2'], function() {

    Route::post('screenshot', 'v2\ScreenshotController@store')->middleware('auth:api');

});