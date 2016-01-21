<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoutesTest extends TestCase
{
    /**
     * @test
     */
    public function it_shows_landingpage()
    {
        $this->visit('/')
             ->see('Screenshot as a Service')
            ->seePageIs('/');
    }

    /**
     * @test
     */
    public function it_shows_feedback_page()
    {
        $this->visit('/')
            ->click('Feedback')
             ->see('Feedback')
            ->seePageIs('/feedback');
    }

    /**
     * @test
     */
    public function it_shows_donate_page()
    {
        $this->visit('/')
            ->click('Donate')
             ->see('Donate')
            ->seePageIs('/donate');
    }

    /**
     * @test
     */
    public function it_shows_try_page()
    {
        $this->visit('/')
            ->click('Try it')
             ->see('Try')
            ->seePageIs('/try');
    }

    /**
     * @test
     */
    public function it_shows_imprint()
    {
        $this->visit('/')
            ->click('Imprint')
             ->see('Imprint')
            ->seePageIs('/imprint');
    }

    /**
     * @test
     */
    public function it_shows_terms_of_service()
    {
        $this->visit('/')
            ->click('Terms')
             ->see('Terms of Service')
            ->seePageIs('/terms');
    }

    /**
     * A Privacy Page is coming soon.
     */
    public function it_shows_privacy_page()
    {
        $this->visit('/')
            ->click('Privacy')
             ->see('Privacy')
            ->seePageIs('/privacy');
    }
}
