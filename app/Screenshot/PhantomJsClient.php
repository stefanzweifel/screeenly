<?php

namespace Screeenly\Screenshot;

use JonnyW\PhantomJs\Client;
use JonnyW\PhantomJs\DependencyInjection\ServiceContainer;

class PhantomJsClient implements ClientInterface
{
    private $client;

    public function __construct()
    {
        return $this->build();
    }

    public function build()
    {
        $client = Client::getInstance();

        $client->getProcedureLoader()->addLoader($this->loadProcedurePartials());

        $client->getEngine()->setPath(base_path().config('screeenly.core.path_to_phantomjs'));
        $client->getEngine()->addOption('--load-images=true');
        $client->getEngine()->addOption('--ignore-ssl-errors=true');
        $client->getEngine()->addOption('--ssl-protocol=any');

        $this->client = $client;

        return $client;
    }

    public function capture(Screenshot $screenshot)
    {
        $request = $this->client->getMessageFactory()->createCaptureRequest($screenshot->url, 'GET');
        $request->setOutputFile($screenshot->storagePath);
        $request->setViewportSize($screenshot->width, $screenshot->getViewportHeight());
        $request->setTimeout(1000);
        $request->setDelay($screenshot->delay);

        /*
         * If height is set by user, crop the image
         */
        if (isset($screenshot->height)) {
            $request->setCaptureDimensions($screenshot->width, $screenshot->height, 0, 0);
        }

        $response = $this->client->getMessageFactory()->createResponse();
        $this->client->send($request, $response);
    }

    /**
     * Load our custom PhantomJS Procedures
     * Let's us directly manipulate the PhantomJS Instance
     *
     * @see http://jonnnnyw.github.io/php-phantomjs/4.0/custom-scripts/
     * @return JonnyW\PhantomJs\Procedure\ProcedureLoader
     */
    public function loadProcedurePartials()
    {
        $location = app_path('Core/Procedures/');
        $serviceContainer = ServiceContainer::getInstance();

        return $serviceContainer->get('procedure_loader_factory')->createProcedureLoader($location);
    }

}
