<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Screeenly\Entities\Url;

class UrlTest extends TestCase
{
    /** @test */
    public function throws_error_if_no_url_is_provied()
    {
        $this->expectException(Exception::class);

        $url = new Url();
    }

    /** @test */
    public function it_returns_sanitized_url()
    {
        $url = new Url('http://foo.com');

        $this->assertEquals($url->getUrl(), 'http://foo.com');
    }
}
