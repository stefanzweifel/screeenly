<?php

namespace Screeenly\Services;

use Screeenly\Entities\Url;
use Screeenly\Entities\Screenshot;
use Spatie\Browsershot\Browsershot;
use Screeenly\Contracts\CanCaptureScreenshot;

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
