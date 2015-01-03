<?php

use Carbon\Carbon;
use JonnyW\PhantomJs\Client;

class APIController extends BaseController {

    private $header;

    private static $rules = [
        'key'    => 'required' ,
        'url'    => 'required|url',
        'width'  => '',
        'height' => ''
    ];

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

        /**
         * ToDo: Move Validation into it's own object
         */
        $validator = Validator::make(Input::all(), static::$rules );

        if ($validator->fails()) {
            $messages = array_flatten($validator->messages());
            App::abort(400, 'Validation Error: ' . $messages[0], $this->header);
        }

        //Generate Filename and path
        $filename      = uniqid() . Str::random(20) . '.jpg';
        $storageFolder = Config::get('api.storage_path');
        $storagePath   = public_path() . '/' . $storageFolder . $filename;
        $assetPath     = asset($storageFolder . $filename);

        $client = Client::getInstance();
        $client->setBinDir(base_path().'/bin');
        $client->addOption('--load-images=true');
        $client->addOption('--ignore-ssl-errors=true');
        $client->addOption('--ssl-protocol=any');

        $request = $client->getMessageFactory()->createCaptureRequest($url, 'GET');
        $request->setCaptureFile($storagePath);
        $request->setViewportSize($width, $height);
        $request->setTimeout(1000);
        $request->setDelay(1); // Delay Rendering for 1 sec (Animations etc.)

        $response = $client->getMessageFactory()->createResponse();
        $client->send($request, $response);

        try {
            $file = File::get($storagePath);
        } catch (Exception $e) {
            App::abort(500, 'Screenshot can\'t be generated for URL: ' . $url, $this->header);
        }

        $bas64 = base64_encode($file);

        $result = [
            'path'       => $assetPath ,
            'base64'     => 'data:image/jpg;base64,' . $bas64,
            'base64_raw' => $bas64
        ];

        //Create Log Entry
        $log = new APILog;
        $log->images   = $filename;
        $log->user()->associate($user);
        $log->save();

        return Response::json($result, 201, $this->header);
    }

}
