<?php

namespace Screeenly\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Http\Request;
use Screeenly\ApiKey;
use Screeenly\ApiLog;
use Screeenly\Http\Controllers\Controller;
use Screeenly\Http\Requests;
use Screeenly\Screenshot\Screenshot;
use Screeenly\Screenshot\ScreenshotValidator;
use Screeenly\Services\CheckHostService;
use Screeenly\User;

class APIController extends Controller
{
    private $header = [
        'Access-Control-Allow-Origin' => '*',
    ];

    /**
     * User implementation.
     *
     * @var Screeenly\User
     */
    protected $user;

    /**
     * Container implementation.
     *
     * @var Illuminate\Contracts\Container\Container
     */
    protected $app;

    /**
     * Response implementation.
     *
     * @var Illuminate\Contracts\Routing\ResponseFactory
     */
    protected $response;

    public function __construct(User $user, ApiLog $log, Response $response)
    {
        $this->user = $user;
        $this->log = $log;
        $this->response = $response;
    }

    /**
     * Create Screenshot.
     *
     * @return Illuminate\Http\Response
     */
    public function createScreenshot(Request $request, ScreenshotValidator $validator, CheckHostService $checkHost, Screenshot $screenshot)
    {
        $url = $request->get('url', 'http://screeenly.com');
        $user = $this->user->getUserByKey($request->get('key'));
        $apiKey = ApiKey::whereKey($request->get('key'))->firstOrFail();

        // Validate Input
        $validator->validate($request->all());

        // Check if Host is available
        $checkHost->ping($url);

        // Actually Capture the Screenshot
        $filename = $screenshot->generateFilename();
        $screenshot->setStoragePath($filename);
        $screenshot->setHeight($request->get('height'));
        $screenshot->setWidth($request->get('width', 1024));
        $screenshot->setDelay($request->get('delay', 1000));
        $screenshot->capture($url);

        $log = $this->log->store($screenshot, $user, $apiKey);

        $this->setRateLimitHeader($request);

        $result = [
            'path' => $screenshot->assetPath ,
            'base64' => 'data:image/jpg;base64,'.$screenshot->base64,
            'base64_raw' => $screenshot->base64,
        ];

        return $this->response->json($result, 201, $this->header);
    }

    /**
     * Set X-RateLimit Headers.
     *
     * @param Illuminate\Http\Request $request
     */
    private function setRateLimitHeader(Request $request)
    {
        $limit     = config('api.ratelimit.requests');
        $time      = config('api.ratelimit.time');
        $key       = sprintf('api:%s', $request->get('key'));
        $count     = \Cache::get($key);
        $remaining = ($limit - $count);

        array_set($this->header, 'X-RateLimit-Limit', $limit);
        array_set($this->header, 'X-RateLimit-Remaining', $remaining);
        array_set($this->header, 'X-RateLimit-Reset', $time);
    }
}
