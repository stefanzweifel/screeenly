<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	/**
	*
	* Display a landingpage
	*
	**/

	public function showLandingpage()
	{
		return View::make('hello');
	}

	/**
	*
	* Show Dashboard with user information
	*
	**/

	public function showDashboard()
	{

        //Get Current user
        $user = User::find( Auth::id() );

        //Get API Calls
        $logs = APILog::where('user_id', '=', $user->id)->orderBy('created_at', 'DESC')->get();

        return View::make('dashboard', compact('user', 'logs'));

	}

}
