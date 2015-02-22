<?php namespace Screeenly\Http\Controllers;

use Screeenly\Screenshot\Screenshot;
use Screeenly\Screenshot\ScreenshotValidator;
use Screeenly\Services\CheckHostService;

use Auth, Input;

class PagesController extends Controller {

	/**
	 * Display Landingpage
	 * @return Illuminate\View\View
	 */
	public function showLandingpage()
	{
		if(Auth::check()) {
			return redirect('/dashboard');
		}
		else {
            return view('marketing.landingpage');
		}
	}

	/**
	 * Display User Dashboard
	 * @return Illuminate\View\View
	 */
	public function showDashboard()
	{
        return view('application.dashboard');
	}

	/**
	 * Diplsay Terms of Service Page
	 * @return Illuminate\View\View
	 */
	public function showTerms()
	{
		return view('terms');
	}

	/**
	 * Display Imprint Page
	 * @return Illuminate\View\View
	 */
	public function showImprint()
	{
		return view('imprint');
	}

	/**
	 * Display Form to Try API
	 * @return Illuminate\View\View
	 */
	public function showTestingForm()
	{
		return view('marketing.tryForm');
	}

	/**
	 * Create Screenshot and Redirect to Try-Route
	 * @return Illuminate\Http\RedirectResponse
	 */
	public function createTestScreenshot()
	{
		$proof = trim(strtolower(Input::get('proof')));

		if ($proof != 'laravel') { return redirect()->route('home.landingpage'); }

        $url  = Input::get('url');

        // Validate Input
        $validator = new ScreenshotValidator();
        $validator->validate(Input::all());

        // Check if Host is available
        $checkHost = new CheckHostService();
        $checkHost->ping($url);

        // Actually Capture the Screenshot
        $screenshot = new Screenshot();
        $filename = $screenshot->generateFilename();
        $screenshot->setPath('images/try/');
        $screenshot->setStoragePath($filename);
        $screenshot->setHeight(Input::get('height'));
        $screenshot->setWidth(Input::get('width', 1024));
        $screenshot->capture($url);

		return redirect()
            ->route('try')
            ->with('asset', $screenshot->assetPath);
	}

}
