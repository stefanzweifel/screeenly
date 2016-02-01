<?php

namespace Screeenly\Core\Client;

use JonnyW\PhantomJs\Client;

class PhantomJsClient extends AbstractClient implements ClientInterface
{
    /**
     * Screeenly\Core\Client\ClientInterface Instance
     * @var Screeenly\Core\Client\ClientInterface
     */
    protected $client;

    /**
     * Boot Browser
     * @return JonnyW\PhantomJs\Client
     */
    public function boot()
    {
        $client = Client::getInstance();
        $client->getEngine()->setPath(base_path() . config('screeenly.core.path_to_phantomjs'));
        $client->getEngine()->addOption('--load-images=true');
        $client->getEngine()->addOption('--ignore-ssl-errors=true');
        $client->getEngine()->addOption('--ssl-protocol=any');

        $this->client = $client;

        return $client;
    }

    /**
     * Capture Screenshot for given URL. Associate Screenshot to given key.
     * @param  string $url
     * @param  string $key ApiKey or null
     * @return Screeenly\Core\Screeenshot\Screenshot
     */
    public function capture($url, $key = null)
    {
        $this->screenshot->set($this, $url, $key);
        $this->screenshot->createDirectory($this->screenshot->getStoragePath());

        $this->isUrlAvailable();
        $this->captureScreenshot();

        $this->screenshot->doesScreenshotExist();
        $this->screenshot->createLogEntry();

        return $this->screenshot;
    }

    /**
     * Contains the acutal logic on how to capture a Screenshot with
     * PhantomJS Headless Browser
     * @return void
     */
    protected function captureScreenshot()
    {
        /**
         * Meh. ¯\_(ツ)_/¯
         */
        if (app()->environment('testing')) {
            return $this->createTestFile($this->screenshot->getFullStoragePath());
        }

        $request = $this->client->getMessageFactory()->createCaptureRequest();

        $request->setMethod('GET');
        $request->setUrl($this->screenshot->getRequestUrl());
        $request->setOutputFile($this->screenshot->getFullStoragePath());
        $request->setViewportSize($this->getWidth(), $this->getViewportHeight());

        /**
         * Add a timeout
         * Prevent Memory issues
         */
        $request->setTimeout(config('screeenly.core.timeout'));

        /**
         * Set a Delay
         * If a website has animations, the content wouldn't be visible on the
         * Screenshot
         */
        $request->setDelay($this->getDelay());

        /*
         * If height is set by user, crop the image
         */
        $height = $this->screenshot->getHeight();
        if (isset($height)) {
            $request->setCaptureDimensions($this->screenshot->getWidth(), $this->screenshot->getHeight(), 0, 0);
        }

        /**
         * "Click"
         */
        $response = $this->client->getMessageFactory()->createResponse();
        $this->client->send($request, $response);

        /**
         * TODO: We should store those logs.
         */
        // $this->client->getLog();
    }
}
