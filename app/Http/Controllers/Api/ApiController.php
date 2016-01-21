<?php

namespace Screeenly\Http\Controllers\Api;

use Illuminate\Http\Request;
use Screeenly\ApiLog;
use Screeenly\Core\Client\PhantomJsClient;
use Screeenly\Core\Requests\ApiRequest;
use Screeenly\Core\Response\ApiResponse;
use Screeenly\Http\Controllers\Controller;
use Screeenly\Http\Requests;
use Screeenly\User;

class ApiController extends Controller
{
    /**
     * Capture Screenshot for a given URL
     * @param  ApiRequest      $request  Validates ApiKey "on the fly"
     * @param  PhantomJsClient $browser  Browser used to capture Screenshot
     * @param  ApiResponse     $response Do Response Stuff
     * @return json
     */
    public function captureScreenshot(ApiRequest $request, PhantomJsClient $browser, ApiResponse $response)
    {
        $browser->boot();

        $browser->setHeight(
            $request->get('height', null)
        );
        $browser->setWidth(
            $request->get('width', null)
        );

        $screenshot = $browser->capture(
            $request->get('url'),
            $request->get('key')
        );

        $response->setRateLimitHeader($screenshot);

        return response()->json(
            $response->getResponseArray($screenshot),
            201,
            $response->getHeaders()
        );
    }
}
