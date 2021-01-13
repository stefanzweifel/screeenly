<?php

use Screeenly\Http\Controllers\App\ApiKeyController;
use Screeenly\Http\Controllers\App\DashboardController;
use Screeenly\Http\Controllers\App\OAuth\GithubController;
use Screeenly\Http\Controllers\App\SettingsController;
use Screeenly\Http\Controllers\App\Setup\EmailController;
use Screeenly\Http\Controllers\App\TryController;

Route::get('try', [TryController::class, 'index'])->name('app.try.index');
Route::post('try', [TryController::class, 'store'])->name('app.try.store');

Route::get('oauth/github/redirect', [GithubController::class, 'redirect'])->name('oauth.github.redirect');
Route::get('oauth/github/handle', [GithubController::class, 'handle'])->name('oauth.github.handle');

// "Setup" or "Onboarding"?
Route::get('setup/email/', [EmailController::class, 'create'])->name('setup.email.create');
Route::post('setup/email', [EmailController::class, 'store'])->name('setup.email.store');

// Routes which require a logged in user
Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['hasEmail'])->name('app.dashboard');

    Route::post('apikeys', [ApiKeyController::class, 'store'])->name('app.apikeys.store');
    Route::delete('apikeys/{apiKey}', [ApiKeyController::class, 'destroy'])->name('app.apikeys.delete');

    Route::get('settings', [SettingsController::class, 'show'])->name('app.settings.show');
    Route::post('settings', [SettingsController::class, 'update'])->name('app.settings.update');
    Route::delete('settings/account', [SettingsController::class, 'delete'])->name('app.settings.delete');
});

Route::view('imprint', 'screeenly::static.imprint');
Route::view('terms', 'screeenly::static.terms');
Route::view('faq', 'screeenly::static.faq');
