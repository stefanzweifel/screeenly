<?php

namespace Screeenly\Core\Client;

use Screeenly\Core\Exception\UnavailableHostException;
use Screeenly\Core\Ping;
use Screeenly\Core\Screeenshot\Screenshot;

abstract class AbstractClient implements ClientInterface
{
    /**
     * Screenshot Instance.
     *
     * @var Screeenly\Core\Screeenshot\Screenshot
     */
    protected $screenshot;

    /**
     * Browser Height.
     *
     * @var int
     */
    protected $height = null;

    /**
     * Browser Width.
     *
     * @var int
     */
    protected $width = null;

    /**
     * Browser Viewport Height.
     *
     * @var int
     */
    protected $viewportHeight = 768;

    /**
     * Delay in Seconds.
     *
     * @var int
     */
    protected $delay = 1;

    public function __construct(Screenshot $screenshot)
    {
        $this->screenshot = $screenshot;

        // Set default values for height and width
        $this->setHeight(null);
        $this->setWidth(null);

        $this->setDelay(config('screeenly.core.delay'));
    }

    /**
     * Set Browser Height.
     *
     * @param int $height
     */
    public function setHeight($height)
    {
        return $this->height = $height;
    }

    /**
     * Set Browser Width.
     *
     * @param int $width
     */
    public function setWidth($width)
    {
        if (is_null($width)) {
            $width = config('screeenly.core.screenshot_width');
        }

        return $this->width = $width;
    }

    /**
     * Return Viewport Height.
     *
     * @return int
     */
    public function getViewportHeight()
    {
        return $this->viewportHeight;
    }

    /**
     * Return Height.
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Return Width.
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set Delay.
     *
     * @param int $delay
     */
    public function setDelay($delay)
    {
        return $this->delay = $delay;
    }

    /**
     * Get Delay.
     *
     * @return int
     */
    public function getDelay()
    {
        return $this->delay;
    }

    /**
     * Check if requested URL is available.
     *
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
     * (Should be replaced by a virtual file system).
     *
     * @param string $path
     *
     * @return void
     */
    public function createTestFile($path)
    {
        \File::put(public_path($path), 'foo');
    }
}
