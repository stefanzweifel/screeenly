<?php

namespace Screeenly\Services;

use Screeenly\Contracts\CanCaptureScreenshot;
use Screeenly\Entities\Screenshot;
use Screeenly\Entities\Url;
use Screeenly\Services\Browser;
use Spatie\Browsershot\Browsershot;

class ChromeBrowser extends Browser implements CanCaptureScreenshot
{
    public function capture(Url $url, $storageUrl)
    {
        Browsershot::url($url->getUrl())
            ->windowSize($this->width, is_null($this->height) ? 768 : $this->height)
            ->timeout(10)
            // ->delay($this->delay)
            ->userAgent('screeenly-bot 2.0')
            ->save($storageUrl);

        return new Screenshot($storageUrl);
    }

}