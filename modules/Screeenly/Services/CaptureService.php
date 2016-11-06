<?php

namespace Screeenly\Services;

use Screeenly\Contracts\CanCaptureScreenshot;
use Screeenly\Entities\Url;
use Screeenly\Services\Browser;

class CaptureService
{
    /**
     * @var Screeenly\Entities\Url
     */
    protected $url;

    /**
     * @var Screeenly\Services\Browser
     */
    protected $browser;

    public function __construct(CanCaptureScreenshot $browser)
    {
        $this->browser = $browser;
    }

    /**
     * Set Height
     * @param  integer $height
     * @return Screeenly\Services\CaptureService
     */
    public function height($height)
    {
        $this->browser->height($height);
        return $this;
    }

    /**
     * Set Width, defaults to 100%
     * @param  integer $width
     * @return Screeenly\Services\CaptureService
     */
    public function width($width)
    {
        $this->browser->width($width);
        return $this;
    }

    /**
     * Set Delay in milliseconds, defaults to 1000
     * @param  integer $delay
     * @return Screeenly\Services\CaptureService
     */
    public function delay($delay)
    {
        $this->browser->delay($delay);
        return $this;
    }

    /**
     * Set Url to capture
     * @param  Screeenly\Models\Url    $url
     * @return Screeenly\Services\CaptureService
     */
    public function url(Url $url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Trigger capture action
     * @return Screeenly\Entities\Screenshot
     */
    public function capture()
    {
        $this->isUrlOnline();

        $storageUrl = storage_path('app/public/screenshot.jpg');

        return $this->browser->capture(
            $this->url,
            $storageUrl
        );
    }

    protected function isUrlOnline()
    {
        // TODO: Implement Ping mechanism to check if a URL is online
        // Throw Exception if url is not available to machine
        return true;
    }
}
