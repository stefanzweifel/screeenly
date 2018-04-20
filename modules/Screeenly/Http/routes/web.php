<?php

Route::get('try', 'TryController@index')->name('app.try.index');
Route::post('try', 'TryController@store')->name('app.try.store');

Route::get('oauth/github/redirect', 'OAuth\GithubController@redirect')->name('oauth.github.redirect');
Route::get('oauth/github/handle', 'OAuth\GithubController@handle')->name('oauth.github.handle');

// "Setup" or "Onboarding"?
Route::get('setup/email/', 'Setup\EmailController@create')->name('setup.email.create');
Route::post('setup/email', 'Setup\EmailController@store')->name('setup.email.store');

// Routes which require a logged in user
Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', 'DashboardController@index')->middleware(['hasEmail'])->name('app.dashboard');

    Route::post('apikeys', 'ApiKeyController@store')->name('app.apikeys.store');
    Route::delete('apikeys/{apiKey}', 'ApiKeyController@destroy')->name('app.apikeys.delete');

    Route::get('settings', 'SettingsController@show')->name('app.settings.show');
    Route::post('settings', 'SettingsController@update')->name('app.settings.update');
    Route::delete('settings/account', 'SettingsController@delete')->name('app.settings.delete');
});

Route::view('imprint', 'screeenly::static.imprint');
Route::view('terms', 'screeenly::static.terms');
Route::view('faq', 'screeenly::static.faq');
