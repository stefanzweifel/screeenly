<?php namespace Screeenly\Screenshot;

use Screeenly\Screenshot\PhantomJsClient as Client;
use Config, Str;

class Screenshot {

    public $url;
    public $width;
    public $height;
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
     * Core method to create a screenshot
     * @param  string $url
     * @return Screeenly\Screenshot\Screenshot
     */
    public function capture($url)
    {
        $this->setUrl($url);
        $this->client->capture($this);

        return $this;
    }

    /**
     * Set Height (Screenshot)
     * @param int $height
     */
    public function setHeight($height)
    {
        return $this->height = $height;
    }

    /**
     * Set Width (Viewport)
     * @param int $width
     */
    public function setWidth($width)
    {
        return $this->width = $width;
    }

    /**
     * Set Url
     * @param string $url
     */
    public function setUrl($url)
    {
        return $this->url = $url;
    }

    /**
     * Set Storage Path
     * @param string $path
     */
    public function setPath($path)
    {
        return $this->path = $path;
    }

    /**
     * Set Filename
     * @param string $filename
     */
    public function setFilename($filename)
    {
        return $this->filename = $filename;
    }

    /**
     * Create new filename
     * @return void
     */
    public function generateFilename()
    {
        $filename = uniqid() . Str::random(20) . '.jpg';
        return $this->setFilename($filename);
    }

    /**
     * Set Storage and Asset Path
     * @param string $filename
     */
    public function setStoragePath($filename)
    {
        $this->assetPath   = asset($this->path . $filename);
        return $this->storagePath = public_path() . '/' . $this->path . $filename;
    }

    public function getViewportHeight()
    {
        return $this->viewportHeight;
    }


}