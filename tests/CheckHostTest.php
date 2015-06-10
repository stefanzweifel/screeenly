<?php

use Screeenly\Services\CheckHostService;

class CheckHostTest extends TestCase
{
    public function testPingForRealUrl()
    {
        $service = new CheckHostService();
        $response = $service->ping('http://www.google.com');

        $this->assertEquals(null, $response);
    }

    /**
     * @expectedException Exception
     */
    public function testPingForWrongUrl()
    {
        $service = new CheckHostService();
        $service->ping('http://www.googleisnotavailable.com');
    }
}
