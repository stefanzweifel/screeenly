<?php

namespace Screeenly\Entities;

use Exception;
use Illuminate\Support\Facades\Storage;

class Screenshot
{
    /**
     * @var string
     */
    protected $base64;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $filename;

    /**
     * @var string
     */
    protected $publicUrl;

    /**
     * Screenshot constructor.
     * @param $absolutePath
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function __construct($absolutePath)
    {
        $this->doesScreenshotExist($absolutePath);
        $this->path = $absolutePath;
        $this->filename = basename($absolutePath);
        $this->publicUrl = asset(Storage::disk(config('screeenly.filesystem_disk'))->url($this->filename));
        $this->base64 = base64_encode(Storage::disk(config('screeenly.filesystem_disk'))->get($this->filename));
    }

    /**
     * Return base64 representation of the Screenshot.
     * @return string
     */
    public function getBase64()
    {
        return $this->base64;
    }

    /**
     * Return the filename of the Screenshot.
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Return the public Url to the screenshot image.
     * @return string
     */
    public function getPublicUrl()
    {
        return $this->publicUrl;
    }

    /**
     * Test if a file is available.
     * @param string $absolutePath
     * @return void
     * @throws Exception
     */
    protected function doesScreenshotExist(string $absolutePath)
    {
        if (config('screeenly.filesystem_disk') == 'public') {
            if (file_exists($absolutePath) == false) {
                throw new Exception("Screenshot can't be generated for given URL");
            }
        } else {
            if (Storage::disk(config('screeenly.filesystem_disk'))->exists($absolutePath) == false) {
                throw new Exception("Screenshot can't be generated for given URL");
            }
        }
    }

    /**
     * Delete Screenshot File from Storage.
     * @return bool
     */
    public function delete()
    {
        return Storage::disk(config('screeenly.filesystem_disk'))->delete($this->filename);
    }
}
