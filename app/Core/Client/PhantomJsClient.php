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
        $client->setBinDir(base_path().'/bin');
        $client->addOption('--load-images=true');
        $client->addOption('--ignore-ssl-errors=true');
        $client->addOption('--ssl-protocol=any');

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

        $request = $this->client->getMessageFactory()->createCaptureRequest($this->screenshot->getRequestUrl(), 'GET');
        $request->setCaptureFile($this->screenshot->getFullStoragePath());
        $request->setViewportSize($this->getWidth(), $this->getViewportHeight());

        /**
         * Add a timeout
         * Prevent Memory issues
         */
        $request->setTimeout($this->config->get('screeenly.core.timeout'));

        /**
         * Set a Delay
         * If a website has animations, the content wouldn't be visible on the
         * Screenshot
         */
        $request->setDelay($this->config->get('screeenly.core.delay'));

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
    }
}
