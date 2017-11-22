<?php

use Screeenly\Contracts\CanCaptureScreenshot;
use Screeenly\Entities\Screenshot;
use Screeenly\Services\ChromeBrowser;

trait InteractsWithBrowser
{
    public function replaceBinding()
    {
        $stub = $this->createMock(ChromeBrowser::class);
        $stub->expects($this->any())
            ->method('capture')
            ->willReturn(new Screenshot(storage_path('testing/test-screenshot.jpg')));

        $this->app->bind(CanCaptureScreenshot::class, function () use ($stub) {
            return $stub;
        });
    }

    public function getTestScreenshotFile()
    {
        return Storage::get('test-screenshot.jpg');
    }
}
