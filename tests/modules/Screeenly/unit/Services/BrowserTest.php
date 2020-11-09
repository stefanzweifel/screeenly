<?php

use Screeenly\Services\Browser;

class BrowserTest extends BrowserKitTestCase
{
    /** @test */
    public function it_sets_height()
    {
        $browser = app(Browser::class);

        $result = $browser->height(100);

        $this->assertEquals($browser->height, 100);
    }

    /** @test */
    public function it_provides_default_value_for_browser_height()
    {
        $browser = app(Browser::class);

        $this->assertEquals($browser->height, null);
    }

    /** @test */
    public function it_sets_width()
    {
        $browser = app(Browser::class);

        $result = $browser->width(100);

        $this->assertEquals($browser->width, 100);
    }

    /** @test */
    public function it_throws_an_error_if_width_is_greater_than_5000_pixels()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Screenshot width can not exceed 5000 Pixels');

        $browser = app(Browser::class);

        $result = $browser->width(6000);
    }

    /** @test */
    public function it_sets_delay()
    {
        $browser = app(Browser::class);

        $result = $browser->delay(5000);

        $this->assertEquals($browser->delay, 5000);
    }

    /** @test */
    public function it_throws_an_error_if_delay_is_greater_than_15_seconds()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Delay can not exceed 15 seconds / 15000 miliseconds');

        $browser = app(Browser::class);

        $result = $browser->delay(15001);
    }

    /** @test */
    public function if_no_browser_properties_are_set_default_values_are_used()
    {
        $browser = app(Browser::class);

        $this->assertEquals(null, $browser->height);
        $this->assertEquals(1024, $browser->width);
        $this->assertEquals(1, $browser->delay);
    }
}
