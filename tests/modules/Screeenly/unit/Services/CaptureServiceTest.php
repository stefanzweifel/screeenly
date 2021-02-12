<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Screeenly\Entities\Screenshot;
use Screeenly\Entities\Url;
use Screeenly\Services\CaptureService;

class CaptureServiceTest extends BrowserKitTestCase
{
    use DatabaseTransactions;
    use InteractsWithBrowser;

    /** @test */
    public function it_lets_you_set_the_height_of_the_screenshot()
    {
        $service = app(CaptureService::class);

        $response = $service->height(100);

        $this->assertEquals($service, $response);
    }

    /** @test */
    public function it_lets_you_set_the_width_of_a_screenshot()
    {
        $service = app(CaptureService::class);

        $response = $service->width(100);

        $this->assertEquals($service, $response);
    }

    /** @test */
    public function it_lets_you_define_a_url()
    {
        $service = app(CaptureService::class);
        $url = new Url('http://foo.com');

        $response = $service->url($url);

        $this->assertEquals($service, $response);
    }

    /** @test */
    public function it_lets_you_define_a_delay()
    {
        $service = app(CaptureService::class);

        $response = $service->delay(1);

        $this->assertEquals($service, $response);
    }

    /** @test */
    public function it_captures_screenshot_and_returns_screenshot_instance()
    {
        Storage::fake(config('screeenly.filesystem_disk'));

        Storage::disk(config('screeenly.filesystem_disk'))
            ->put(
                'test-screenshot.jpg',
                file_get_contents(storage_path('testing/test-screenshot.jpg'))
            );

        $this->replaceBinding();

        $service = app(CaptureService::class);
        $url = new Url('http://foo.com');

        $screenshot = $service->url($url)->capture();

        $this->assertInstanceOf(Screenshot::class, $screenshot);
        $this->assertEquals('test-screenshot.jpg', $screenshot->getFilename());
        $this->assertEquals(storage_path('testing/test-screenshot.jpg'), $screenshot->getPath());
    }

    /** @test */
    public function it_throws_an_exception_if_passed_url_is_not_available()
    {
        $this->expectException(\Exception::class);

        $service = app(CaptureService::class);
        $url = new Url('http://foo_bar');

        $response = $service->url($url);
    }
}
