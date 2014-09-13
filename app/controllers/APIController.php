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
    public function createScreenshot()
    {
        //Debug
        $startTime = time();

        $url    = Input::get('url', 'http://screeenly.com');
        $user   = User::getUserByKey( Input::get('key') );
        $width  = Input::get('width', 1024);
        $height = Input::get('height', 768);
        $url    = $this->addHttp($url);

        //Generate Filename and path
        $filename       = uniqid().Str::random(20).'.jpg';
        $storage_folder = Config::get('api.storage_path');
        $storage_path   = public_path().'/'.$storage_folder.$filename;
        $return_path    = asset($storage_folder.$filename);


        $client = Client::getInstance();
        $client->setBinDir(base_path().'/bin');
        $client->addOption('--load-images=true');
        $client->addOption('--ignore-ssl-errors=true');

        $request = $client->getMessageFactory()->createCaptureRequest($url, 'GET');
        $request->setCaptureFile($storage_path);
        $request->setViewportSize($width, $height);
        $request->setTimeout(1000);
        $request->setDelay(1); // Delay Rendering for 1 sec (Animations etc.)

        $response = $client->getMessageFactory()->createResponse();
        $client->send($request, $response);

        //Debug
        $endTime = time();
        $debug = [
            'exex_time' => ($endTime - $startTime)
        ];

        $result = [
            'debug'    => $debug,
            'filename' => $return_path,
        ];


        //Create Log Entry
        $log = new APILog;
        $log->payload  = json_encode( Input::all() );
        $log->response = json_encode( $result );
        $log->images   = $filename;
        $log->user()->associate($user);
        $log->save();

        //Push Queue to delete Screenshot in a week
        // $date = Carbon::now()->addWeeks(1);
        // Queue::later($date, 'IronController@deleteScreenshot', ['id' => $log->id]);
        Queue::push('IronController@deleteScreenshot', ['id' => $log->id]);

        return Response::json($result, 201, $this->header);

    }

    /**
     * Add HTTP to a URL, if it not exists
     * @param  string $url
     * @return string
     */
    public function addHttp($url) {

        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return $url;

    }


}
