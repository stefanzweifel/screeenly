<?php

use Screeenly\Core\Client\ClientInterface;
use Screeenly\Core\Client\PhantomJsClient;
use Screeenly\Core\Screeenshot\Screenshot;

class PhantomJsClientTest extends TestCase
{
    protected function getMockedClass()
    {
        return \Mockery::mock(PhantomJsClient::class);
    }

    public function testInitializeClass()
    {
        $browser = app()->make(PhantomJsClient::class);

        $this->assertInstanceOf(PhantomJsClient::class, $browser);
        $this->assertInstanceOf(ClientInterface::class, $browser);
    }

    /**
     * @test
     */
    public function it_can_boot_mock()
    {
        $browser = app()->make(PhantomJsClient::class);

        $browser->boot();
    }

    /**
     * @test
     */
    public function it_captures_screenshot()
    {
        /*
         * The capture() method it self is not really testable. The method is
         * just a collection of other methods which are called. Mostly on the
         * Screenshot object.
         * So I should first write tests for the Screenshot Object and can then
         * return to this test.
         */

        return;

        $browser = app()->make(PhantomJsClient::class);

        $browser->boot();

        $screenshot = $browser->capture('http://google.com');

        $this->assertInstanceOf(Screenshot::class, $screenshot);
    }
}
