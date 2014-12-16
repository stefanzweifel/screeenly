<?php

use Carbon\Carbon;
use JonnyW\PhantomJs\Client;

class APIController extends BaseController {

    private $header;

    public function __construct()
    {
        $this->header = ['Access-Control-Allow-Origin' => '*'];
    }

    /**
     * Create a screenshot with Phantom JS
     * @return void
     */
    public function createFullSizeScreenshot()
    {
        $url    = Input::get('url', 'http://screeenly.com');
        $user   = User::getUserByKey( Input::get('key') );
        $width  = Input::get('width', 1024);
        $height = Input::get('height', 768);
        $url    = $this->prepareURL($url);

        //Generate Filename and path
        $filename      = uniqid() . Str::random(20) . '.jpg';
        $storageFolder = Config::get('api.storage_path');
        $storagePath   = public_path() . '/' . $storageFolder . $filename;
        $assetPath     = asset($storageFolder . $filename);

        $client = Client::getInstance();
        $client->setBinDir(base_path().'/bin');
        $client->addOption('--load-images=true');
        $client->addOption('--ignore-ssl-errors=true');

        $request = $client->getMessageFactory()->createCaptureRequest($url, 'GET');
        $request->setCaptureFile($storagePath);
        $request->setViewportSize($width, $height);
        $request->setTimeout(1000);
        $request->setDelay(1); // Delay Rendering for 1 sec (Animations etc.)

        $response = $client->getMessageFactory()->createResponse();
        $client->send($request, $response);

        $file = File::get($storagePath);

        $result = [
            'path'   => $assetPath ,
            'base64' =>  'data:image/jpg;base64,' . base64_encode($file)
        ];

        //Create Log Entry
        $log = new APILog;
        $log->images   = $filename;
        $log->user()->associate($user);
        $log->save();

        return Response::json($result, 201, $this->header);
    }

    /**
     * Add HTTP to a URL, if it not exists
     * @param  string $url
     * @return string
     */
    public function prepareURL($url) {

        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return $url;

    }


}
