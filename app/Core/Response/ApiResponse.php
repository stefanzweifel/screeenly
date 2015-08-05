<?php

namespace Screeenly\Core\Response;

use Screeenly\Core\Screeenshot\Screenshot;
use Config;
use Cache;

class ApiResponse {

    protected $header = [
        'Access-Control-Allow-Origin' => '*',
    ];

    public function getHeaders()
    {
        return $this->header;
    }

    public function getResponseArray(Screenshot $screenshot)
    {
        return [
            'path'       => $screenshot->getResponsePath(),
            'base64'     => 'data:image/jpg;base64,'.$screenshot->getBase64(),
            'base64_raw' => $screenshot->getBase64(),
        ];
    }


    public function setRateLimitHeader($screenshot)
    {
        $key = $screenshot->getKey();

        if (!is_null($key)) {

            $key       = sprintf('api:%s', $screenshot->getKey()->key);

        }

        $limit     = Config::get('screeenly.api.ratelimit.requests');
        $time      = Config::get('screeenly.api.ratelimit.time');
        $count     = Cache::get($key);
        $remaining = ($limit - $count);

        array_set($this->header, 'X-RateLimit-Limit', $limit);
        array_set($this->header, 'X-RateLimit-Remaining', $remaining);
        array_set($this->header, 'X-RateLimit-Reset', $time);
    }

}