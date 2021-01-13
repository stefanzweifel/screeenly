<?php

use Screeenly\Http\Controllers\Api\v1\ScreenshotController as ScreenshotControllerV1;
use Screeenly\Http\Controllers\Api\v2\ScreenshotController as ScreenshotControllerv2;

Route::group(['prefix' => 'v1'], function () {
    Route::post('fullsize', [ScreenshotControllerV1::class, 'store'])->middleware('auth:api');
});

Route::group(['prefix' => 'v2'], function () {
    Route::post('screenshot', [ScreenshotControllerv2::class, 'store'])->middleware('auth:api');
});
