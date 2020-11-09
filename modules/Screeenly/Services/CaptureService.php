<?php

namespace Screeenly\Services;

use Illuminate\Support\Str;
use Screeenly\Contracts\CanCaptureScreenshot;
use Screeenly\Entities\Url;

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
     * Set Height.
     * @param  int $height
     * @return Screeenly\Services\CaptureService
     */
    public function height($height)
    {
        $this->browser->height($height);

        return $this;
    }

    /**
     * Set Width, defaults to 100%.
     * @param  int $width
     * @return Screeenly\Services\CaptureService
     */
    public function width($width)
    {
        $this->browser->width($width);

        return $this;
    }

    /**
     * Set Delay in milliseconds, defaults to 1000.
     * @param  int $delay
     * @return Screeenly\Services\CaptureService
     */
    public function delay($delay)
    {
        $this->browser->delay($delay);

        return $this;
    }

    /**
     * Set Url to capture.
     * @param  Screeenly\Models\Url    $url
     * @return Screeenly\Services\CaptureService
     */
    public function url(Url $url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Trigger capture action.
     * @return Screeenly\Entities\Screenshot
     */
    public function capture()
    {
        $filename = uniqid().'_'.Str::random(30) . ".png";

        return $this->browser->capture(
            $this->url,
            $filename
        );
    }
}
