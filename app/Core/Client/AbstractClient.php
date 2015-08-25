<?php

namespace Screeenly\Core\Client;

use Illuminate\Contracts\Config\Repository as Config;
use Screeenly\Core\Exception\UnavailableHostException;
use Screeenly\Core\Ping;
use Screeenly\Core\Screeenshot\Screenshot;

abstract class AbstractClient implements ClientInterface
{
    /**
     * Config Repository
     * @var Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * Screenshot Instance
     * @var Screeenly\Core\Screeenshot\Screenshot
     */
    protected $screenshot;

    /**
     * Browser Height
     * @var int
     */
    protected $height;

    /**
     * Browser Width
     * @var int
     */
    protected $width;

    /**
     * Browser Viewport Height
     * @var integer
     */
    protected $viewportHeight = 768;

    public function __construct(Config $config, Screenshot $screenshot)
    {
        $this->config     = $config;
        $this->screenshot = $screenshot;

        // Set default values for height and width
        $this->setHeight(null);
        $this->setWidth(null);
    }

    /**
     * Set Browser Height
     * @param int $height
     */
    public function setHeight($height)
    {
        return $this->height = $height;
    }

    /**
     * Set Browser Width
     * @param int $width
     */
    public function setWidth($width)
    {
        if (is_null($width)) {
            $width = $this->config->get('screeenly.core.screenshot_width');
        }

        return $this->width = $width;
    }

    /**
     * Return Viewport Height
     * @return int
     */
    public function getViewportHeight()
    {
        return $this->viewportHeight;
    }

    /**
     * Return Height
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Return Width
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Check if requested URL is available
     * @return void
     */
    public function isUrlAvailable()
    {
        $url = $this->screenshot->getRequestUrl();
        $ping = app()->make(Ping::class);

        if ($ping->isUp($url) === false) {
            throw new UnavailableHostException("The URL {$url} is unavailable.", 422);
        }
    }


    /**
     * Create an empty file for testing purposes.
     * (Should be replaced by a virtual file system)
     * @param  string $path
     * @return void
     */
    public function createTestFile($path)
    {
        \File::put(public_path($path), 'foo');
    }
}
