<?php

namespace Screeenly\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Screeenly\Entities\Url;
use Screeenly\Http\Requests\TryRequest;
use Screeenly\Services\CaptureService;

class TryController extends Controller
{
    /**
     * Show View to let user enter URL to create a new screenshot.
     * @return View
     */
    public function index()
    {
        return view('screeenly::try');
    }

    /**
     * Try to capture website screenshot.
     * @param  TryRequest     $request        Form Request to Validate Input
     * @param  CaptureService $captureService Service Class which handles capturing websites
     * @return Redirect
     */
    public function store(TryRequest $request, CaptureService $captureService)
    {
        try {
            $screenshot = $captureService
                ->width(1440)
                ->delay(1)
                ->url(new Url($request->url))
                ->capture();

            $screenshot->delete();

            return redirect('try')->with('base64', $screenshot->getBase64());
        } catch (Exception $e) {
            \Sentry\captureException($e);

            return redirect('try')->with('fatal-error', true);
        }
    }
}
