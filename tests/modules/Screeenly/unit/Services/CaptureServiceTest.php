<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Screeenly\Contracts\CanCaptureScreenshot;
use Screeenly\Entities\Screenshot;
use Screeenly\Entities\Url;
use Screeenly\Services\CaptureService;
use Screeenly\Services\PhantomsJsBrowser;

class CaptureServiceTest extends TestCase
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
        $this->markTestIncomplete('Implement logic to test if an URL is online.');

        $service = app(CaptureService::class);
        $url = new Url('http://foo.com');

        $response = $service->url($url);
    }


}
