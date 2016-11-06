<?php

Route::get('/', function () {
    if (! auth()->check()) {
        return view('welcome');
    }

    return redirect('dashboard');
});

Auth::routes();

// Looking for Route specific to Screeenly?
// They moved here:
// /modules/Screeenly/Http/routes/

