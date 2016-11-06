<?php

namespace Screeenly\Services;

use JonnyW\PhantomJs\Client;
use JonnyW\PhantomJs\DependencyInjection\ServiceContainer;
use Screeenly\Contracts\CanCaptureScreenshot;
use Screeenly\Entities\Screenshot;
use Screeenly\Entities\Url;

class PhantomsJsBrowser extends Browser implements CanCaptureScreenshot
{
    public function capture(Url $url, $storageUrl)
    {
        $location = base_path('modules/Screeenly/Procedures/');
        $serviceContainer = ServiceContainer::getInstance();
        $serviceContainer->get('procedure_loader_factory')->createProcedureLoader($location);

        $client = Client::getInstance();

        $client->getEngine()->setPath(base_path('vendor/bin/phantomjs'));
        $client->getEngine()->addOption('--load-images=true');
        $client->getEngine()->addOption('--ignore-ssl-errors=true');
        $client->getEngine()->addOption('--ssl-protocol=any');

        $request = $client->getMessageFactory()->createCaptureRequest();
        $request->setMethod('GET');
        $request->setUrl($url->getUrl());
        $request->setOutputFile($storageUrl);
        $request->setViewportSize($this->width, $this->height);
        $request->setTimeout(1000);
        $request->setDelay($this->delay);

        /*
         * If height is set by user, crop the image
         */
        // $height = $this->screenshot->getHeight();
        // if (isset($height)) {
        //     // $request->setCaptureDimensions($this->screenshot->getWidth(), $this->screenshot->getHeight(), 0, 0);
        // }

        $response = $client->getMessageFactory()->createResponse();
        $client->send($request, $response);

        return new Screenshot($storageUrl);
    }
}
