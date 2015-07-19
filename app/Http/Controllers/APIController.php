<?php

namespace Screeenly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Container\Container as App;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Screeenly\User;
use Screeenly\APILog;

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

    public function __construct(User $user, App $app, APILog $log, Response $response)
    {
        $this->user = $user;
        $this->app = $app;
        $this->log = $log;
        $this->response = $response;
    }

    /**
     * Create Screenshot.
     *
     * @return Illuminate\Http\Response
     */
    public function createScreenshot(Request $request)
    {
        $url = $request->get('url', 'http://screeenly.com');
        $user = $this->user->getUserByKey($request->get('key'));

        // Validate Input
        $validator = $this->app->make('Screeenly\Screenshot\ScreenshotValidator');
        $validator->validate($request->all());

        // Check if Host is available
        $checkHost = $this->app->make('Screeenly\Services\CheckHostService');
        $checkHost->ping($url);

        // Actually Capture the Screenshot
        $screenshot = $this->app->make('Screeenly\Screenshot\Screenshot');
        $filename = $screenshot->generateFilename();
        $screenshot->setStoragePath($filename);
        $screenshot->setHeight($request->get('height'));
        $screenshot->setWidth($request->get('width', 1024));
        $screenshot->capture($url);

        $log = $this->log->store($screenshot, $user);

        $this->setRateLimitHeader($request);

        $result = [
            'path' => $screenshot->assetPath ,
            'base64' => 'data:image/jpg;base64,'.$screenshot->bas64,
            'base64_raw' => $screenshot->bas64,
        ];

        return $this->response->json($result, 201, $this->header);
    }

    /**
     * Set X-RateLimit Headers.
     *
     * @param Illuminate\Http\Request $request
     */
    private function setRateLimitHeader($request)
    {
        $limit     = \Config::get('api.ratelimit.requests');
        $time      = \Config::get('api.ratelimit.time');
        $key       = sprintf('api:%s', $request->get('key'));
        $count     = \Cache::get($key);
        $remaining = ($limit - $count);

        array_set($this->header, 'X-RateLimit-Limit', $limit);
        array_set($this->header, 'X-RateLimit-Remaining', $remaining);
        array_set($this->header, 'X-RateLimit-Reset', $time);
    }
}
