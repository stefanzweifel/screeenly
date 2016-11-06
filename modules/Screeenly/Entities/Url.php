<?php

namespace Screeenly\Entities;

class Url
{
    /**
     * @var string
     */
    protected $url;

    public function __construct($url)
    {
        $this->url = $this->sanitizeUrl($url);
    }

    /**
     * Return the sanitized Url
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sanitize the URl
     * @param  string $url
     * @return string
     */
    protected function sanitizeUrl($url)
    {
        // TODO: Sanitize Url
        return $url;
    }
}
