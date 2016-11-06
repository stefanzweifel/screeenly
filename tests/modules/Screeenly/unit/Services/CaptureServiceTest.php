<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Screeenly\Services\CaptureService;

class CaptureServiceTest extends TestCase
{
    use DatabaseTransactions;

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
        // it lets you define a url
    }

    /** @test */
    public function it_lets_you_define_a_delay()
    {
        $service = app(CaptureService::class);

        $response = $service->delay(1000);

        $this->assertEquals($service, $response);
    }


}
