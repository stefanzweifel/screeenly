<?php

namespace Screeenly\Services;

use Screeenly\Entities\Url;
use JonnyW\PhantomJs\Client;
use Screeenly\Entities\Screenshot;
use Screeenly\Contracts\CanCaptureScreenshot;
use JonnyW\PhantomJs\DependencyInjection\ServiceContainer;

class PhantomsJsBrowser extends Browser implements CanCaptureScreenshot
{
    /**
     * Capture Url and store image in given Path.
     * @param  Url    $url
     * @param  string $storageUrl
     * @return Screeenly\Entities\Screenshot
     */
    public function capture(Url $url, $storageUrl)
    {
        $serviceContainer = ServiceContainer::getInstance();
        $serviceContainer->get('procedure_loader_factory')->createProcedureLoader(base_path('modules/Screeenly/Procedures/'));

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
