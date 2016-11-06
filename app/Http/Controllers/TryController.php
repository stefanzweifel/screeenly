<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Screeenly\Entities\Url;
use Screeenly\Http\Requests\TryRequest;
use Screeenly\Services\CaptureService;

class TryController extends Controller
{
    /**
     * Show View to let user enter URL to create a new screenshot
     * @return View
     */
    public function index()
    {
        return view('app.try');
    }

    /**
     * Try to capture website screenshot
     * @param  TryRequest     $request        Form Request to Validate Input
     * @param  CaptureService $captureService Service Class which handles capturing websites
     * @return Redirect
     */
    public function store(TryRequest $request, CaptureService $captureService)
    {
        try {

            $screenshot = $captureService
                ->width(1024)
                ->delay(1)
                ->url(new Url($request->url))
                ->capture();

            return redirect('try')->with('base64', $screenshot->getBase64());

        } catch (Exception $e) {
            return redirect('try')->with('fatal-error', true);
        }
    }
}
