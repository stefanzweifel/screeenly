<?php

namespace Screeenly\Core\Client;

use Config;

abstract class AbstractClient implements ClientInterface
{

    protected $height;

    protected $width;

    protected $viewportHeight = 768;

    public function setHeight($height)
    {
        return $this->height = $height;
    }

    public function setWidth($width)
    {
        if (is_null($width)) {
            $width = Config::get('screeenly.core.screenshot_width');
        }

        return $this->width = $width;
    }

    public function getViewportHeight()
    {
        return $this->viewportHeight;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getWidth()
    {
        return $this->width;
    }

    /**
     * "Boot" the Headless browser and set default values
     * @param  int $width
     * @param  int $height
     * @return void
     */
    public function boot($width = null, $height = null)
    {
        $this->setHeight($height);
        $this->setWidth($width);

        return $this;
    }

    public function doesFolderExist()
    {

    }

}