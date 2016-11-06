<?php

namespace Screeenly\Entities;

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

    // TODO: Maybe we should pass the File Object here.
    public function __construct($absolutePath)
    {
        $this->doesScreenshotExist($absolutePath);
        $this->path = $absolutePath;
        $this->filename = basename($absolutePath);
        $this->publicUrl = asset(\Storage::url('public/screenshot.jpg'));
        $this->base64 = base64_encode(\Storage::get('public/screenshot.jpg'));
    }

    /**
     * Return base64 representation of the Screenshot
     * @return string
     */
    public function getBase64()
    {
        return $this->base64;
    }

    /**
     * Return the filename of the Screenshot
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    public function getPath()
    {
        return $this->path;
    }

    /**
     * Return the public Url to the screenshot image
     * @return string
     */
    public function getPublicUrl()
    {
        return $this->publicUrl;
    }

    protected function doesScreenshotExist($absolutePath)
    {
        if (! \Storage::has('public/screenshot.jpg')) {
            throw new \Exception("Screenshot can't be generated for URL {URL}.", 400);
        }
    }
}
