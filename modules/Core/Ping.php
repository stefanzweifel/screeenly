<?php

namespace Screeenly\Core;

class Ping
{
    /**
     * Check if given URL is available.
     *
     * @param string $url
     *
     * @return bool
     */
    public function isUp($url)
    {
        $request = curl_init($url);
        curl_setopt($request, CURLOPT_TIMEOUT, 5);
        curl_setopt($request, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($request, CURLOPT_NOBODY, true);

        $result = curl_exec($request);
        curl_close($request);

        if ($result === false) {
            return false;
        }

        return true;
    }
}
