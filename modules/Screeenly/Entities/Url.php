<?php

namespace Screeenly\Entities;

use Exception;

class Url
{
    /**
     * @var string
     */
    protected $url;

    public function __construct($url)
    {
        $this->url = $url;

        $this->isValid();
    }

    /**
     * Return the sanitized Url.
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Test if the passed URL has a valid format
     * @return boolean
     */
    protected function isValid()
    {
        if (!filter_var($this->url, FILTER_VALIDATE_URL)) {
            throw new Exception("The URL {$this->url} is invalid.");
        }
    }
}
