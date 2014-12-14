<?php

Route::get('/', [
    'as' => 'home.landingpage',
    'uses' => 'PagesController@showLandingpage'
]);

Route::get('/docs', [
    'as' => 'front.documentation',
    'uses' => 'PagesController@showDocumentation'
]);

Route::get('/terms', [
    'as' => 'front.terms',
    'uses' => 'PagesController@showTerms'
]);

Route::get('/imprint', [
    'as' => 'front.imprint',
    'uses' => 'PagesController@showImprint'
]);



Route::group(['prefix' => 'oauth'], function(){

    Route::get('authorize', array(
        'as' => 'oauth.github',
        'uses' => 'OAuthController@authorize_github')
    );

    Route::get('response', [
        'as' => 'oauth.response',
        'uses' => 'OAuthController@response'
        ]);

    Route::get('logout', array(
        'as' => 'oauth.logout',
        'uses' => 'OAuthController@logout'
        ));

});


/**
*
* API Controller
*
**/

Route::group(['prefix' => 'api', 'before' => 'api-auth'], function(){


    Route::group(['prefix' => 'v1'], function(){

        /**
        *
        * Create Screenshot from payload
        *
        **/

        Route::post('screen', array(
            'as' => 'api.screen',
            'uses' => 'APIController@createScreenshot'
        ));

    });

});


/**
*
* Display Dashboard
*
**/

Route::group(['before' => 'auth'], function(){

    Route::get('dashboard', array(
        'as' => 'front.dashboard',
        'uses' => 'PagesController@showDashboard'
    ));

    Route::post('resetAPIKey', array(
        'as' => 'front.resetAPIKey',
        'uses' => 'UserController@resetAPIKey'
    ));

    Route::post('close', array(
        'as' => 'front.closeAccount',
        'uses' => 'UserController@closeAccount'
    ));

});