<?php

namespace Tests\Feature\Web;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StaticPageTest extends TestCase
{
    #[Test]
    public function it_loads_terms_of_service_page()
    {
        $this->get('/terms')->assertOk();
    }

    #[Test]
    public function it_loads_faq_page()
    {
        $this->get('/faq')->assertOk();
    }

    #[Test]
    public function it_loads_imprint_page()
    {
        $this->get('/imprint')->assertOk();
    }
}
