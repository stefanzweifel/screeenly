<?php

namespace Screeenly\Services;

use Exception;

class Browser
{
    /**
     * @var int
     */
    public $height = null;

    /**
     * @var int
     */
    public $width = 1024;

    /**
     * @var int
     */
    public $delay = 1;

    /**
     * Set Height.
     * @param  int $height
     * @return Screeenly\Services\Browser
     */
    public function height($height = 100)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Set Width, defaults to 100%.
     * @param  int $width
     * @return Screeenly\Services\Browser
     */
    public function width($width = 100)
    {
        if ($width > 5000) {
            throw new Exception('Screenshot width can not exceed 5000 Pixels');
        }
        $this->width = $width;

        return $this;
    }

    /**
     * Set Delay in miliseconds, defaults to 1000.
     * @param  int $delay
     * @return Screeenly\Services\Browser
     */
    public function delay($delay = 1000)
    {
        if ($delay > 15000) {
            throw new Exception('Delay can not exceed 15 seconds / 15000 miliseconds');
        }

        $this->delay = $delay;

        return $this;
    }
}
