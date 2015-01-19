<?php

use Screeenly\Api\ScreenshotBuilder;

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

	/**
	 * Display Form to Try API
	 * @return Illuminate\View\View
	 */
	public function showTestingForm()
	{
		return View::make('marketing.tryForm');
	}

	/**
	 * Create Screenshot and Redirect to Try-Route
	 * @return Illuminate\Http\RedirectResponse
	 */
	public function createTestScreenshot()
	{
		$proof = strtolower(Input::get('proof'));

		if ($proof != 'laravel') { return Redirect::route('home.landingpage'); }

		$screenshot = new ScreenshotBuilder();
		$screenshot->execute();

		return Redirect::route('try')->with('asset', $screenshot->assetPath);
	}

}
