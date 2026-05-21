<?php

use App\Http\Controllers\Auth\RegisterController;
use Carbon\Carbon;
use Illuminate\Http\Request;

Route::get('/', function () {
    if (! auth()->check()) {
        return view('welcome');
    }

    return redirect('dashboard');
});

Auth::routes(['register' => false]);

Route::middleware('guest')->group(function () {
    Route::get('register', function () {
        if (now()->gte(Carbon::parse(config('screeenly.dusk_date')))) {
            return view('auth.registration-closed');
        }

        return view('auth.register');
    })->name('register');

    Route::post('register', function (Request $request) {
        if (now()->gte(Carbon::parse(config('screeenly.dusk_date')))) {
            return view('auth.registration-closed');
        }

        return app(RegisterController::class)->register($request);
    });
});

// Looking for Route specific to Screeenly?
// They moved here:
// /modules/Screeenly/Http/routes/
