<?php

namespace Screeenly\Services;

use Exception;
use Screeenly\Entities\Screenshot;
use Screeenly\Entities\Url;
use Screeenly\Contracts\CanCaptureScreenshot;

class Browser
{
    /**
     * @var integer
     */
    public $height = null;

    /**
     * @var integer
     */
    public $width = 1024;

    /**
     * @var integer
     */
    public $delay = 1;

    /**
     * Set Height
     * @param  integer $height
     * @return Screeenly\Services\Browser
     */
    public function height($height = 100)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * Set Width, defaults to 100%
     * @param  integer $width
     * @return Screeenly\Services\Browser
     */
    public function width($width = 100)
    {
        if ($width > 5000) {
            throw new Exception("Screenshot width can not exceed 5000 Pixels");
        }
        $this->width = $width;
        return $this;
    }

    /**
     * Set Delay in miliseconds, defaults to 1000
     * @param  integer $delay
     * @return Screeenly\Services\Browser
     */
    public function delay($delay = 1000)
    {
        if ($delay > 10000) {
            throw new Exception("Delay can not exceed 10 seconds / 10000 miliseconds");
        }

        $this->delay = $delay;
        return $this;
    }
}
