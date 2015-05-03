<?php namespace Screeenly\Services;

use Screeenly\Exceptions\HostNotFoundException;

class CheckHostService {

    /**
     * Do a simple CURL Request to given URL
     * @param  string $url
     * @return void
     */
    public function ping($url)
    {
        $ch = curl_init($url);
              curl_setopt($ch, CURLOPT_TIMEOUT, 5);
              curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
              curl_setopt($ch, CURLOPT_NOBODY, true);

        $result = curl_exec($ch);
        curl_close($ch);

        if ($result === false) {
            throw new HostNotFoundException("Host for URL: $url is not available", 400);
        }
    }

}