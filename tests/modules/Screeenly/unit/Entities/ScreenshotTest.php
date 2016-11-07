<?php

use Screeenly\Entities\Screenshot;

class ScreenshotTest extends TestCase
{
    /** @test */
    public function it_sets_properties_on_screenshot()
    {
        $file = Storage::get('test-screenshot.jpg');
        $path = storage_path('testing/test-screenshot.jpg');
        $screenshot = new Screenshot($path);

        $this->assertEquals(
            base64_encode($file),
            $screenshot->getBase64());

        $this->assertEquals(
            'test-screenshot.jpg',
            $screenshot->getFilename()
        );

        $this->assertEquals(
            $path,
            $screenshot->getPath()
        );
    }

    /** @test */
    public function it_throws_exception_if_screenshot_is_not_available()
    {
        $this->expectException(Exception::class);

        $path = storage_path('foo.jpg');
        $screenshot = new Screenshot($path);
    }
}
