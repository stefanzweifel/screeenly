<?php

namespace Tests\Feature\Web;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MarketingPageTest extends TestCase
{
    #[Test]
    public function it_loads_marketing_page_and_shows_product_name()
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('screeenly')
            ->assertSee('Screenshot as a Service');
    }

    #[Test]
    public function it_shows_github_signup_button()
    {
        $this->get('/')
            ->assertSee('Github');
    }
}
