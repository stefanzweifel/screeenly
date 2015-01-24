<?php namespace Screeenly\Screenshot;

use JonnyW\PhantomJs\Client;
use Screeenly\Screenshot\Screenshot;

class PhantomJsClient implements ClientInterface {

    private $client;

    public function __construct()
    {
        return $this->build();
    }

    public function build()
    {
        $client = Client::getInstance();
        $client->setBinDir(base_path() . '/bin');
        $client->addOption('--load-images=true');
        $client->addOption('--ignore-ssl-errors=true');
        $client->addOption('--ssl-protocol=any');

        $this->client = $client;

        return $client;
    }

    public function capture(Screenshot $screenshot)
    {
        $request = $this->client->getMessageFactory()->createCaptureRequest($screenshot->url, 'GET');
        $request->setCaptureFile($screenshot->storagePath);
        $request->setViewportSize($screenshot->width, $screenshot->getViewportHeight());
        $request->setTimeout(1000);
        $request->setDelay(1); // Delay Rendering for 1 sec (Animations etc.)

        /**
         * If height is set by user, crop the image
         */
        if (isset($screenshot->height)) {
            $request->setCaptureDimensions($screenshot->width, $screenshot->height, 0, 0);
        }

        $response = $this->client->getMessageFactory()->createResponse();
        $this->client->send($request, $response);

    }

}