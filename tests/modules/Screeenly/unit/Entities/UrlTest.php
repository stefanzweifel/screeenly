<?php

use Screeenly\Entities\Url;

class UrlTest extends TestCase
{
    /** @test */
    public function it_returns_sanitized_url()
    {
        $url = new Url('http://foo.com');

        $this->assertEquals($url->getUrl(), 'http://foo.com');
    }
}
