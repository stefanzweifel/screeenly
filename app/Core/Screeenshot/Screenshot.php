<?php

namespace Screeenly\Core\Screeenshot;

use Screeenly\ApiLog;
use Config;

class Screenshot extends AbstractScreenshot
{
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
        $domain = Config::get('app.url');

        return "$domain/{$this->getFullStoragePath()}";
    }
}
