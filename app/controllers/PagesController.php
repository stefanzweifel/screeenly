<?php

class PagesController extends BaseController {

	/**
	 * Display Landingpage
	 * @return Illuminate\View\View
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
	 * @return Illuminate\View\View
	 */
	public function showDashboard()
	{
        return View::make('application.dashboard');
	}

	/**
	 * Show dedicated documentation page
	 * @return Illuminate\View\View
	 */
	public function showDocumentation()
	{
		return View::make('documentation.start');
	}

	/**
	 * Diplsay Terms of Service Page
	 * @return Illuminate\View\View
	 */
	public function showTerms()
	{
		return View::make('terms');
	}

	/**
	 * Display Imprint Page
	 * @return Illuminate\View\View
	 */
	public function showImprint()
	{
		return View::make('imprint');
	}

}
