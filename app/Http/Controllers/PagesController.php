<?php

namespace Screeenly\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Log;
use Screeenly\Core\Client\PhantomJsClient;
use Screeenly\Screenshot\Screenshot;

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
        $apikeys = auth()->user()->apikeys()->latest()->get(['name', 'key', 'created_at', 'id']);

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
     * Create screenshot through webinterface.
     *
     * @param Request         $request
     * @param PhantomJsClient $browser
     *
     * @return redirect
     */
    public function createTestScreenshot(Request $request, PhantomJsClient $browser)
    {
        $proof = trim(strtolower($request->get('proof')));

        if ($proof != 'laravel') {
            return back()->withMessage('Wrong answer. Hint: Laravel.');
        }

        try {
            $browser->boot();
            $screenshot = $browser->capture($request->get('url'), null);

            return redirect()
                ->route('try')
                ->withAsset($screenshot->getResponsePath());
        } catch (Exception $e) {

            if (app()->bound('bugsnag')) {
                app('bugsnag')->notifyException($e, null, "error");
            }

            return redirect()
                    ->route('try')
                    ->withError('Oh snap! Something went wrong, please try again.')
                    ->withInput();
        }
    }
}
