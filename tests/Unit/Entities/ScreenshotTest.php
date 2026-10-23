<?php

namespace Tests\Unit\Entities;

use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Screeenly\Entities\Screenshot;
use Tests\TestCase;

class ScreenshotTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Storage::disk(config('screeenly.filesystem_disk'))->put('test-screenshot.jpg', file_get_contents(storage_path('testing/test-screenshot.jpg')));
    }

    #[Test]
    public function it_sets_properties_on_screenshot()
    {
        $file = Storage::get('test-screenshot.jpg');
        $path = storage_path('testing/test-screenshot.jpg');
        $screenshot = new Screenshot($path);

        $this->assertEquals(
            base64_encode($file),
            $screenshot->getBase64()
        );

        $this->assertEquals(
            'test-screenshot.jpg',
            $screenshot->getFilename()
        );

        $this->assertEquals(
            $path,
            $screenshot->getPath()
        );
    }

    #[Test]
    public function it_throws_exception_if_screenshot_is_not_available()
    {
        $this->expectException(\Exception::class);

        $path = storage_path('foo.jpg');
        $screenshot = new Screenshot($path);
    }

    #[Test]
    public function it_deletes_screenshot_from_disk()
    {
        Storage::disk(config('screeenly.filesystem_disk'))->delete('test-screenshot.jpg');

        Storage::put(
            'test-screenshot-to-delete.jpg',
            file_get_contents(storage_path('testing/test-screenshot.jpg'))
        );

        $path = storage_path('app/public/test-screenshot-to-delete.jpg');
        $screenshot = new Screenshot($path);

        $this->assertTrue($screenshot->delete());

        Storage::disk(config('screeenly.filesystem_disk'))->assertMissing('test-screenshot-to-delete.jpg');
    }
}
