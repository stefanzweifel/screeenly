<?php

namespace Screeenly\Http\Controllers;

use Illuminate\Http\Request;
use Screeenly\Core\Client\PhantomJsClient;
use Screeenly\Http\Controllers\Controller;
use Screeenly\Http\Requests;
use Screeenly\Screenshot\Screenshot;
use Log;
use Exception;

class PagesController extends Controller
{
    /**
     * Display Landingpage.
     *
     * @return Illuminate\View\View
     */
    public function showLandingpage()
    {
        if (auth()->check()) {
            return redirect('/dashboard');
        } else {
            return view('static.landingpage');
        }
    }

    /**
     * Display User Dashboard.
     *
     * @return Illuminate\View\View
     */
    public function showDashboard()
    {
        $apikeys = auth()->user()->apikeys()->latest()->get(["name", "key", "created_at", "id"]);

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
     * Create screenshot through webinterface
     * @param  Request                                $request
     * @param  PhantomJsClient $browser
     * @return redirect
     */
    public function createTestScreenshot(Request $request, PhantomJsClient $browser)
    {
        $proof = trim(strtolower($request->get('proof')));

        if ($proof != 'laravel') {
            return back()->withMessage("Wrong answer. Hint: Laravel.");
        }

        try {
            $browser->boot();
            $screenshot = $browser->capture($request->get('url'), null);
            return redirect()
                ->route('try')
                ->withAsset($screenshot->getResponsePath());

        } catch (Exception $e) {

            // If something happens, send error to Sentry
            Log::error($e);

            return redirect()
                    ->route('try')
                    ->withError("Oh snap! Something went wrong, please try again.")
                    ->withInput();

        }


    }
}
