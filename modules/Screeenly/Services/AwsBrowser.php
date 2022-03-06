<?php

namespace Screeenly\Services;

use Illuminate\Support\Facades\Storage;
use Screeenly\Contracts\CanCaptureScreenshot;
use Screeenly\Entities\Screenshot;
use Screeenly\Entities\Url;
use Wnx\SidecarBrowsershot\BrowsershotLambda;

class AwsBrowser extends Browser implements CanCaptureScreenshot
{
    public function capture(Url $url, $filename)
    {
        $browser = BrowsershotLambda::url($url->getUrl())
            ->ignoreHttpsErrors()
            ->windowSize($this->width, is_null($this->height) ? 768 : $this->height)
            ->timeout(30)
            ->setDelay($this->delay * 1000)
            ->userAgent('screeenly-bot 2.0');


        if (config('screeenly.disable_sandbox')) {
            $browser->noSandbox();
        }

        if (is_null($this->height)) {
            $browser->fullPage();
        }

        Storage::disk(config('screeenly.filesystem_disk'))->put($filename, $browser->screenshot());

        $path = Storage::disk(config('screeenly.filesystem_disk'))->path($filename);

        return new Screenshot($path);
    }
}
