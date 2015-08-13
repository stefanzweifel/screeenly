<?php

namespace Screeenly\Core\Screeenshot;

use Screeenly\ApiKey;
use Screeenly\ApiLog;
use Screeenly\Core\Client\ClientInterface as Client;
use File;
use Illuminate\Contracts\Config\Repository as Config;

abstract class AbstractScreenshot implements ScreenshotInterface
{
    /**
     * Height of Screenshot
     * @var int
     */
    protected $height;

    /**
     * Width of Screenshot
     * @var int
     */
    protected $width;

    /**
     * Filename of Screenshot File
     * @var string
     */
    protected $filename;

    /**
     * URL where Screenshot is generated from
     * @var string
     */
    protected $requestUrl;

    /**
     * Base64 Encoded String of File
     * @var string
     */
    protected $base64;

    /**
     * Combined storagePath and filename
     * @var string
     */
    protected $fullStoragePath;

    /**
     * Folderpath where screenshot is stored
     * @var string
     */
    protected $storagePath;

    /**
     * ApiKey Instance
     * @var Screeenly\ApiKey
     */
    protected $key;

    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;;
    }

    public function set(Client $browser, $requestUrl, $key)
    {
        $this->browser = $browser;

        $this->cloneDimensions();

        $this->generateFilename();
        $this->setStoragePath();

        $this->setFullStoragePath();

        $this->setRequestUrl($requestUrl);

        $this->setKey($key);
    }

    /**
     * Set Height of Screenshot
     * @param int $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
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
     * Set Width
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Return Width
     * @param int $width
     */
    public function setWidth($width)
    {
        return $this->width = $width;
    }

    /**
     * Set Request Url
     * @param string $requestUrl
     */
    public function setRequestUrl($requestUrl)
    {
        return $this->requestUrl = $requestUrl;
    }

    /**
     * Return Request Url
     * @return string
     */
    public function getRequestUrl()
    {
        return $this->requestUrl;
    }

    /**
     * Encode File into base64
     * @return string
     */
    public function getBase64()
    {
        $file = $this->doesScreenshotExist();

        return $this->base64 =  base64_encode($file);
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
     * Get Filename
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Generate a new unique filename
     * @return string
     */
    public function generateFilename()
    {
        $unique = uniqid(str_random(25));

        $filename = "$unique.jpg";

        return $this->setFilename($filename);
    }

    /**
     * Set Storage Path
     * @param string $storagePath Optional override to default value
     */
    public function setStoragePath($storagePath = null)
    {
        if (is_null($storagePath)) {
            $storagePath = $this->config->get('screeenly.core.storage_path');
        }

        return $this->storagePath = $storagePath;
    }

    /**
     * Return storage path
     * @return string
     */
    public function getStoragePath()
    {
        return $this->storagePath;
    }

    /**
     * Return full storage path
     * @return string
     */
    public function getFullStoragePath()
    {
        return $this->getStoragePath().$this->getFilename();
    }

    /**
     * Set full storage path
     */
    public function setFullStoragePath()
    {
        return $this->fullStoragePath = $this->getFullStoragePath();
    }

    /**
     * Set Api Key
     * @param mixed (string|null) $key
     */
    public function setKey($key)
    {
        if (!is_null($key)) {

            // TODO: Inject "ApiKey" through DI (for better tests)
            $key = ApiKey::whereKey($key)->first();

            if (!$key) {
                throw new \Screeenly\Core\Exception\InvalidApiKeyException("Api-Key not found");
            }
        }

        return $this->key = $key;
    }

    /**
     * Return ApiKey Model
     * @return mixed (string|null)
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Clone Browser dimensions to Screenshot Object
     * @return void
     */
    public function cloneDimensions()
    {
        $this->setHeight($this->browser->getHeight());
        $this->setWidth($this->browser->getWidth());
    }

    /**
     * Test if screenshot exists
     * @return stream
     */
    public function doesScreenshotExist()
    {
        try {
            // TODO: Should use Flysystem API. Should be injected through DI
            $file = File::get($this->getFullStoragePath());
            return $file;
        } catch (\Illuminate\Contracts\Filesystem\FileNotFoundException $e) {
            throw new \Screeenly\Core\Exception\ScreenshotNotExistsException("Screenshot can't be generated for URL {$this->getRequestUrl()}");
        }
    }


    /**
     * Check if set storage path is writable
     * @return void
     */
    public function createDirectory()
    {
        $path = public_path($this->getStoragePath());

        // TODO: Should use Flysystem API. Should be injected through DI
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }
    }


    /**
     * Create ApiLog Entry
     * @return Screeenly\ApiLog
     */
    public function createLogEntry()
    {
        $path = public_path($this->getFullStoragePath());

        $log = new ApiLog();
        $log->images = $path;

        if (is_null($this->key)) {
            $log->user_id    = null;
            $log->api_key_id = null;
        } else {
            $log->user()->associate($this->key->user);
            $log->apiKey()->associate($this->key);
        }

        $log->save();

        return $log;
    }

    /**
     * Return path to generated image
     * @return string
     */
    public function getResponsePath()
    {
        $domain = $this->config->get('app.url');

        return "$domain/{$this->getFullStoragePath()}";
    }

}
