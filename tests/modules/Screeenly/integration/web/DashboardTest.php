<?php

use Screeenly\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DashboardTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_loads_dashboard_for_logged_in_user()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
                ->visit('/dashboard')
                ->see('Dashboard');
    }

    /** @test */
    public function it_redirects_logged_in_user_to_dashboard_route()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
                ->visit('/')
                ->seePageIs('dashboard')
                ->see('Dashboard');
    }

    /** @test */
    public function it_redirects_not_logged_in_user_to_login_page()
    {
        $this->visit('/dashboard')
                ->see('screeenly')
                ->seePageIs('login');
    }

    /** @test */
    public function it_redirects_user_to_setup_email_page_if_his_account_does_not_have_an_email_address()
    {
        $user = factory(User::class)->create(['email' => '']);

        $this->actingAs($user)
                ->visit('/dashboard')
                ->seePageIs('setup/email')
                ->see("You're account doesn't have an email address yet.");
    }

    /** @test */
    public function it_does_not_user_to_setup_email_page_if_account_has_an_email_address()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
                ->visit('/')
                ->seePageIs('dashboard')
                ->see('Dashboard');
    }
}
