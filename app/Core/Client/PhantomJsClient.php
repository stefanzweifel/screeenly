<?php

namespace Screeenly\Core\Client;

use JonnyW\PhantomJs\Client;
use Screeenly\Core\Screeenshot\Screenshot;
use Config;

class PhantomJsClient extends AbstractClient implements ClientInterface
{
    /**
     * Screeenly\Core\Client\ClientInterface Instance
     * @var Screeenly\Core\Client\ClientInterface
     */
    protected $client;

    public function __construct()
    {
        return $this->build();
    }

    public function build()
    {
        $client = Client::getInstance();
        $client->setBinDir(base_path().'/bin');
        $client->addOption('--load-images=true');
        $client->addOption('--ignore-ssl-errors=true');
        $client->addOption('--ssl-protocol=any');

        $this->client = $client;

        return $client;
    }

    public function capture($url, $key = null)
    {
        $screenshot = new Screenshot($this, $url, $key);

        $screenshot->createDirectory();

        // Execute PhantomJs Browser and create screenshot
        $this->captureScreenshot($screenshot);

        $screenshot->doesScreenshotExist();
        $screenshot->createLogEntry();

        return $screenshot;
    }


    public function captureScreenshot($screenshot)
    {
        $request = $this->client->getMessageFactory()->createCaptureRequest($screenshot->getRequestUrl(), 'GET');
        $request->setCaptureFile($screenshot->getFullStoragePath());
        $request->setViewportSize($this->getWidth(), $this->getViewportHeight());
        $request->setTimeout(Config::get('screeenly.core.timeout'));
        $request->setDelay(Config::get('screeenly.core.delay'));

        /*
         * If height is set by user, crop the image
         */
        $height = $screenshot->getHeight();
        if (isset($height)) {
            $request->setCaptureDimensions($screenshot->getWidth(), $screenshot->getHeight(), 0, 0);
        }

        $response = $this->client->getMessageFactory()->createResponse();
        $this->client->send($request, $response);
    }
}
