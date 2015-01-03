<?php

class APIController extends BaseController {

    private $header;

    public function __construct()
    {
        $this->header = ['Access-Control-Allow-Origin' => '*'];
    }

    /**
     * Create a screenshot with Phantom JS
     * @return Illuminate\Http\RedirectResponse
     */
    public function createFullSizeScreenshot()
    {
        $screenshot = new Screeenly\Api\ScreenshotBuilder($this->header);
        return $screenshot->execute();
    }

}
