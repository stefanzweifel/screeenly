<?php

class StaticPageTest extends BrowserKitTestCase
{
    /** @test */
    public function it_loads_terms_of_service_page()
    {
        $this->visit('/terms');
    }

    /** @test */
    public function it_loads_faq_page()
    {
        $this->visit('/faq');
    }

    /** @test */
    public function it_loads_imprint_page()
    {
        $this->visit('/imprint');
    }
}
