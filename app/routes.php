<?php

/**
*
* Landingpage
*
**/

Route::get('/', [
    'as' => 'home.landingpage',
    'uses' => 'HomeController@showLandingpage'
]);

Route::get('/docs', [
    'as' => 'front.documentation',
    'uses' => 'HomeController@showDocumentation'
]);

Route::get('/terms', [
    'as' => 'front.terms',
    'uses' => 'HomeController@showTerms'
]);

Route::get('/imprint', [
    'as' => 'front.imprint',
    'uses' => 'HomeController@showImprint'
]);

/**
*
* OAuth System
*
**/

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



Route::get('login', function(){

    return Redirect::to('/');

});

/**
*
* API Controller
*
**/

Route::group(['prefix' => 'api'], function(){


    /**
    *
    * API - Version 1.0
    *
    * @author Stefan Zweifel
    *
    **/

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
            'uses' => 'HomeController@showDashboard'
        ));

        Route::get('settings', array(
            'as' => 'front.settings',
            'uses' => 'HomeController@showSettings'
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