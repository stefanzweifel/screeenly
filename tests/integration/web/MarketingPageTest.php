<?php


class MarketingPageTest extends TestCase
{
    /** @test */
    public function it_loads_marketing_page_and_shows_product_name()
    {
        $this->visit('/')
             ->see('screeenly')
             ->see('Screenshot as a Service');
    }

    /** @test */
    public function it_shows_github_signup_button()
    {
        $this->visit('/')
            ->see('Github');
    }

    /** @test */
    public function it_shows_bugsnag_as_sponsor()
    {
        $this->visit('/')
            ->see('Bugsnag');
    }
}
