<?php

use Screeenly\Entities\Url;

class UrlTest extends TestCase
{
    /** @test */
    public function it_returns_url()
    {
        $url = new Url('http://foo.com');

        $this->assertEquals('http://foo.com', $url->getUrl());
    }

    /** @test */
    public function it_throws_exception_if_url_is_invalid()
    {
        $this->expectException(\Exception::class);

        new Url('http://foo_bar');
    }
}
