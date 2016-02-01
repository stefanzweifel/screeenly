<?php

namespace Screeenly\Screenshot;

use Screeenly\Screenshot\PhantomJsClient as Client;
use Config;
use File;
use App;

class Screenshot
{
    public $url;
    public $width;
    public $height;
    public $delay;
    public $path;
    public $filename;

    public $assetPath;
    public $base64;

    public $storagePath;

    private $viewportHeight = 768;

    private $client;

    public function __construct()
    {
        $client = new Client();
        $this->client = $client;
        $this->setPath(Config::get('api.storage_path'));
    }

    /**
     * Core method to create a screenshot.
     *
     * @param string $url
     *
     * @return Screeenly\Screenshot\Screenshot
     */
    public function capture($url)
    {
        $this->setUrl($url);

        if (App::environment() != 'testing') {
            $this->client->capture($this);
            $this->doesScreenshotExist();
        }

        return $this;
    }

    /**
     * Set Height (Screenshot).
     *
     * @param int $height
     */
    public function setHeight($height)
    {
        return $this->height = $height;
    }

    /**
     * Set Width (Viewport).
     *
     * @param int $width
     */
    public function setWidth($width)
    {
        return $this->width = $width;
    }

    /**
     * Set Url.
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        return $this->url = $url;
    }

    /**
     * Set Storage Path.
     *
     * @param string $path
     */
    public function setPath($path)
    {
        return $this->path = $path;
    }

    /**
     * Set Filename.
     *
     * @param string $filename
     */
    public function setFilename($filename)
    {
        return $this->filename = $filename;
    }

    /**
     * Set Delay in Seconds
     * @param integer $delayInMiliSeconds
     */
    public function setDelay($delayInMiliSeconds)
    {
        return $this->delay = ($delayInMiliSeconds / 1000);
    }

    /**
     * Create new filename.
     */
    public function generateFilename()
    {
        $filename = uniqid().str_random(20).'.jpg';

        return $this->setFilename($filename);
    }

    /**
     * Set Storage and Asset Path.
     *
     * @param string $filename
     */
    public function setStoragePath($filename)
    {
        $this->assetPath = asset($this->path.$filename);

        $storagePath = public_path($this->path);

        $this->createDirectory($storagePath);

        return $this->storagePath = $storagePath.$filename;
    }

    /**
     * Return ViewportHeight.
     *
     * @return int
     */
    public function getViewportHeight()
    {
        return $this->viewportHeight;
    }

    /**
     * Check if Screenshot Exists in Filesystem.
     */
    private function doesScreenshotExist()
    {
        try {
            $file = File::get($this->storagePath);
        } catch (\Illuminate\Contracts\Filesystem\FileNotFoundException $e) {
            App::abort(400, "Screenshot can't be generated for URL $this->url");
        }

        $this->base64 = base64_encode($file);
    }

    /**
     * Create Storage Directory, if it doesnt exist yet
     * @param  string $path
     * @return void
     */
    protected function createDirectory($path)
    {
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }
    }
}
