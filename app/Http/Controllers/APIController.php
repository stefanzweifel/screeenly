<?php namespace Screeenly\Http\Controllers;

use Screeenly\Screenshot\Screenshot;
use Screeenly\Screenshot\ScreenshotValidator;
use Screeenly\Services\CheckHostService;

use Input, Response;
use Screeenly\User;
use Screeenly\APILog;

class APIController extends Controller {

    private $header = ['Access-Control-Allow-Origin' => '*'];

    /**
     * Create Screenshot
     * @return Illuminate\Http\Response
     */
    public function createScreenshot()
    {
        $url  = Input::get('url', 'http://screeenly.com');
        $user = User::getUserByKey( Input::get('key') );

        // Validate Input
        $validator = new ScreenshotValidator();
        $validator->validate(Input::all());

        // Check if Host is available
        $checkHost = new CheckHostService();
        $checkHost->ping($url);

        // Actually Capture the Screenshot
        $screenshot = new Screenshot();
        $filename = $screenshot->generateFilename();
        $screenshot->setStoragePath($filename);
        $screenshot->setHeight(Input::get('height'));
        $screenshot->setWidth(Input::get('width', 1024));
        $screenshot->capture($url);

        $log = APILog::store($screenshot, $user);

        $result = [
            'path'       => $screenshot->assetPath ,
            'base64'     => 'data:image/jpg;base64,' . $screenshot->bas64,
            'base64_raw' => $screenshot->bas64
        ];

        return Response::json($result, 201, $this->header);

    }

}
