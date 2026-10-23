<?php

namespace Tests\Unit\Entities;

use PHPUnit\Framework\Attributes\Test;
use Screeenly\Entities\Url;
use Tests\TestCase;

class UrlTest extends TestCase
{
    #[Test]
    public function it_returns_url()
    {
        $url = new Url('http://foo.com');

        $this->assertEquals('http://foo.com', $url->getUrl());
    }

    #[Test]
    public function it_throws_exception_if_url_is_invalid()
    {
        $this->expectException(\Exception::class);

        new Url('http://foo_bar');
    }
}
