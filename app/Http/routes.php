<?php

Route::get('/', ['as' => 'home.landingpage', 'uses' => 'PagesController@showLandingpage']);
Route::get('terms', ['as' => 'front.terms', 'uses' => 'StaticController@showTerms']);
Route::get('imprint', ['as' => 'front.imprint', 'uses' => 'StaticController@showImprint']);
Route::get('donate', ['as' => 'front.donate', 'uses' => 'StaticController@showDonate']);

// Route::get('privacy', ['as' => 'front.privacy', 'uses' => 'StaticController@privacy']);

Route::get('login', ['as' => 'login', 'uses' => 'OAuthController@redirectToProvider']);
Route::get('handle', ['as' => 'login_handler', 'uses' => 'OAuthController@handleProviderCallback']);
Route::get('logout', ['as' => 'oauth.logout', 'uses' => 'OAuthController@logout']);

Route::get('try', ['as' => 'try', 'uses' => 'PagesController@showTestingForm']);

Route::post('try', [
    'as' => 'try.do',
    'middleware' => 'csrf',
    'uses' => 'PagesController@createTestScreenshot',
]);

Route::get('feedback', ['as' => 'app.feedback', 'uses' => 'StaticController@showFeedback']);
Route::get('faq', ['as' => 'app.faq', 'uses' => 'StaticController@showFaq']);

/*
 * Account Routes
 */
Route::group(['middleware' => 'auth'], function () {

    Route::get('dashboard', array(
        'as'         => 'app.dashboard',
        'uses'       => 'PagesController@showDashboard',
        'middleware' => 'app.hasEmail',
    ));

    Route::resource('apikeys', 'ApiKeysController', ['except' => ['index', 'create']]);

    Route::delete('close', ['as' => 'app.closeAccount', 'uses' => 'UserController@closeAccount']);
    Route::get('email-setup', ['as' => 'app.storeEmailForm', 'uses' => 'PagesController@showEmailForm']);
    Route::post('email-setup', ['as' => 'app.storeEmail', 'uses' => 'UserController@storeEmail']);
    Route::get('settings', ['as' => 'app.settings', 'uses' => 'PagesController@showSettings']);

});

/*
 * API Routes
 */
Route::group(['prefix' => 'api', 'middleware' => ['api.auth', 'api.throttle']], function () {

    Route::group(['prefix' => 'v1'], function () {

        Route::post('fullsize', array(
            'as' => 'api.fullsize',
            'uses' => 'APIController@createScreenshot',
        ));

    });

    Route::group(['prefix' => 'v2', 'middleware' => 'api.accept_json_header'], function() {

        Route::post('fullsize', array(
            'uses' => 'Api\ApiController@captureScreenshot'
        ));

    });

});
