<?php

namespace Screeenly\Core\Client;

interface ClientInterface
{
    /**
     * Boot Headless Browser
     * Perfect to setup default values
     * @return void
     */
    public function boot();

    /**
     * Method to capture a Screenshot
     * @param  string $url
     * @param  mixed $key
     * @return Screeenly\Core\Screeenshot\Screenshot
     */
    public function capture($url, $key = null);
}
