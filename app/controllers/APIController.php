<?php

// use JonnyW\PhantomJs\Client;

class APIController extends BaseController {

    private $header;


    public function __construct()
    {
        $this->header = ['Access-Control-Allow-Origin' => '*'];
    }


    /**
    *
    * Take screenshot from website
    * via phantomJS
    *
    **/

    public function createScreenshot()
    {
        //Debug
        $startTime = time();

        //Get Input
        $api_key = Input::get('key');
        $url     = Input::get('url', 'http://google.com');
        $width   = Input::get('width', 1024);
        $height  = Input::get('height', 768);

        //Check API-Key
        if( $user = User::getUserByKey($api_key) )
        {

            //Generate Filename and path
            $filename       = uniqid().Str::random(20).'.jpg';
            $storage_folder = Config::get('api.storage_path');
            $storage_path   = public_path().'/'.$storage_folder.$filename;
            $return_path    = asset($storage_folder.$filename);


            $browsershot = new Spatie\Browsershot\Browsershot();
            $browsershot
                    ->setURL($url)
                    ->setWidth($width)
                    ->setHeight($height)
                    ->save($storage_path);



            //Debug
            $endTime = time();
            $debug = [
                'exex_time' => ($endTime - $startTime)
            ];

            $result = [
                'debug'    => $debug,
                'filename' => $return_path
            ];


            //Create Log Entry
            $log = new APILog;
            $log->payload  = json_encode( Input::all() );
            $log->response = json_encode( $result );
            $log->images   = $filename;
            $log->user()->associate($user);
            $log->save();

            return Response::json($result, 201, $this->header);

        }
        else {
            return Response::json('Wrong API key', 401, $this->header);
        }

    }


}
