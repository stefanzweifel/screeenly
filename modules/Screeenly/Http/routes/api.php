<?php

Route::group(['prefix' => 'v1'], function() {

    Route::get('test', function(){

        $service =  app()->make(Screeenly\Services\CaptureService::class);
        $url     = new Screeenly\Entities\Url('http://google.com');

        $screenshot = $service->height(1000)->width(1024)->url($url)->capture();

        ?>
        <img src="data:image/jpg;base64,<?php echo $screenshot->getBase64() ?>" alt="">
        <?php

    });

    Route::post('fullsize', '\Screeenly\Http\Controllers\Api\v1\ScreenshotController@store')->name('api.v1.fullsize')->middleware('auth:api');

});

Route::group(['prefix' => 'v2'], function() {

    Route::post('screenshot', '\Screeenly\Http\Controllers\Api\v2\ScreenshotController@store')->name('api.v2.screenshot.store')->middleware('auth:api');

});