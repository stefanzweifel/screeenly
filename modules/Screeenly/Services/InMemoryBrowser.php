<?php

namespace Screeenly\Services;

use Screeenly\Entities\Url;
use Screeenly\Entities\Screenshot;
use Screeenly\Contracts\CanCaptureScreenshot;

class InMemoryBrowser extends Browser implements CanCaptureScreenshot
{
    /**
     * Capture Url and store image in given Path.
     * @param  Url    $url
     * @param  string $storageUrl
     * @return Screeenly\Entities\Screenshot
     */
    public function capture(Url $url, $storageUrl)
    {
        return new Screenshot(storage_path('testing/test-screenshot.jpg'));
    }
}
