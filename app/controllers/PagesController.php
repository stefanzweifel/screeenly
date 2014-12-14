<?php

class PagesController extends BaseController {

	/**
	 * Display Landingpage
	 * @return void
	 */
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
	 * Display User Dashboard
	 * @return void
	 */
	public function showDashboard()
	{
        //Get Current user
        $user = User::find( Auth::id() );

        //Get API Calls
        $logs = APILog::where('user_id', '=', $user->id)->orderBy('created_at', 'DESC')->get();

        return View::make('application.dashboard', compact('user', 'logs'));

	}

	/**
	 * Show dedicated documentation page
	 * @return void
	 */
	public function showDocumentation()
	{
		return View::make('documentation.start');
	}

	/**
	 * Diplsay Terms of Service Page
	 * @return void
	 */
	public function showTerms()
	{
		return View::make('terms');
	}

	/**
	 * Display Imprint Page
	 * @return void
	 */
	public function showImprint()
	{
		return View::make('imprint');
	}

}
