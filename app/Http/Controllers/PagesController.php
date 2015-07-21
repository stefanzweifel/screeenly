<?php

namespace Screeenly\Http\Controllers;

use Auth;
use Input;
use Screeenly\ApiLog;
use Screeenly\Screenshot\Screenshot;
use Screeenly\Screenshot\ScreenshotValidator;
use Screeenly\Services\CheckHostService;
use Illuminate\Http\Request;
use Screeenly\Http\Requests;
use Screeenly\Http\Controllers\Controller;

class PagesController extends Controller
{
    /**
     * Display Landingpage.
     *
     * @return Illuminate\View\View
     */
    public function showLandingpage()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        } else {
            $screenshots = \Cache::remember('global.screenshot_count', 5, function () {

                $result = ApiLog::select('id')->withTrashed()->latest()->first();

                if ($result) {
                    return $result->id;
                }

                return 0;
            });

            return view('static.landingpage', compact('screenshots'));
        }
    }

    /**
     * Display User Dashboard.
     *
     * @return Illuminate\View\View
     */
    public function showDashboard()
    {
        $apikeys = auth()->user()->apikeys()->latest()->get();

        return view('app.dashboard', compact('apikeys'));
    }

    /**
     * Display Form to Try API.
     *
     * @return Illuminate\View\View
     */
    public function showTestingForm()
    {
        return view('marketing.tryForm');
    }

    /**
     * Show Settings Screeen.
     *
     * @return Illuminate\View\View
     */
    public function showSettings()
    {
        return view('app.settings');
    }

    /**
     * Show Form to store Email.
     *
     * @return Illuminate\View\View
     */
    public function showEmailForm()
    {
        return view('app.storeEmail');
    }

    /**
     * Create Screenshot and Redirect to Try-Route.
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function createTestScreenshot(Request $request)
    {
        $proof = trim(strtolower($request->get('proof')));

        if ($proof != 'laravel') {
            return back()->withMessage("Wrong answer. Hint: Laravel.");
        }

        $url = $request->get('url');

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
        $screenshot->setHeight($request->get('height'));
        $screenshot->setWidth($request->get('width', 1024));
        $screenshot->capture($url);

        return redirect()
            ->route('try')
            ->with('asset', $screenshot->assetPath);
    }
}
