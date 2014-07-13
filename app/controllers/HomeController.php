<?php

class HomeController extends BaseController {

	/**
	*
	* Display a landingpage
	*
	**/

	public function showLandingpage()
	{

		if(Auth::check()) {
			return Redirect::to('/dashboard');
		}
		else {
			return View::make('marketing.landingpage');
		}

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

        return View::make('application.dashboard', compact('user', 'logs'));

	}

	/**
	 * Show dedicated settings page
	 * @return void
	 */
	public function showSettings()
	{

		$user = User::find( Auth::id() );
		$logs = APILog::where('user_id', '=', $user->id)->orderBy('created_at', 'DESC')->get();

		return View::make('application.settings', compact('user', 'logs'));
	}

	/**
	 * Show dedicated documentation page
	 * @return void
	 */
	public function showDocumentation()
	{
		return View::make('documentation.start');
	}

	public function showTerms()
	{
		return View::make('terms');
	}

	public function showImprint()
	{
		return View::make('imprint');
	}

}
