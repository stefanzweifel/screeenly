<?php

use Screeenly\Api\ScreenshotBuilder;

class APIController extends BaseController {

    private $header;

    public function __construct()
    {
        $this->header = ['Access-Control-Allow-Origin' => '*'];
    }

    /**
     * Create a screenshot with Phantom JS
     * @return Illuminate\Http\Response
     */
    public function createFullSizeScreenshot()
    {
        $screenshot = new ScreenshotBuilder();
        $screenshot->execute();

        $result = [
            'path'       => $screenshot->assetPath ,
            'base64'     => 'data:image/jpg;base64,' . $screenshot->bas64,
            'base64_raw' => $screenshot->bas64
        ];

        $screenshot->createLog();

        return Response::json($result, 201, $this->header);
    }

}
