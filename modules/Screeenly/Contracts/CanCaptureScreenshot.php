<?php

namespace Screeenly\Contracts;

use Screeenly\Entities\Url;

interface CanCaptureScreenshot
{
    public function capture(Url $url, $storageUrl);
}
