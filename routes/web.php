<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/dashboard', function () {
    return view('welcome');
});



Route::get('oauth/github/redirect', 'OAuth\GithubController@redirect')->name('oauth.github.redirect');
Route::get('oauth/github/handle', 'OAuth\GithubController@handle')->name('oauth.github.handle');

// "Setup" or "Onboarding"?
Route::get('setup/email/', 'Setup\EmailController@create')->name('setup.email.create');
Route::post('setup/email', 'Setup\EmailController@store')->name('setup.email.store');
