<?php

Route::get('/', function () {
    if (! auth()->check()) {
        return view('welcome');
    }

    return redirect('dashboard');
});

Auth::routes();




// Static Pages
Route::get('imprint', 'StaticPageController@imprint');
Route::get('terms', 'StaticPageController@terms');
Route::get('about', 'StaticPageController@about');
Route::get('about', 'StaticPageController@about');
Route::get('privacy', 'StaticPageController@privacy');
