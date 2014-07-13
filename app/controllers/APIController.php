<?php

use Carbon\Carbon;

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

        //Get Input
        $api_key = Input::get('key');
        $url     = Input::get('url', 'http://screeenly.com');
        $width   = Input::get('width', 1024);
        $height  = Input::get('height', 768);

        $url = $this->addhttp($url);

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

            //Push Queue to delete Screenshot in a week
            $date = Carbon::now()->addWeeks(1);
            Queue::later($date, 'IronController@deleteScreenshot', ['id' => $log->id]);

            return Response::json($result, 201, $this->header);

        }
        else {
            return Response::json('Wrong API key', 401, $this->header);
        }

    }

    /**
     * Add HTTP to a URL, if it not exists
     * @param  string $url
     * @return string
     */
    public function addhttp($url) {

        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return $url;

    }


}
