<?php

Route::get('/', function () {
    if (! auth()->check()) {
        return view('welcome');
    }

    return redirect('dashboard');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('oauth/github/redirect', 'OAuth\GithubController@redirect')->name('oauth.github.redirect');
Route::get('oauth/github/handle', 'OAuth\GithubController@handle')->name('oauth.github.handle');

// "Setup" or "Onboarding"?
Route::get('setup/email/', 'Setup\EmailController@create')->name('setup.email.create');
Route::post('setup/email', 'Setup\EmailController@store')->name('setup.email.store');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('app.dashboard');
    })->middleware(['hasEmail'])->name('app.dashboard');

    Route::get('settings', 'SettingsController@show')->name('app.settings.show');
    Route::post('settings', 'SettingsController@update')->name('app.settings.update');
    Route::delete('settings/account', 'SettingsController@delete')->name('app.settings.delete');
});
