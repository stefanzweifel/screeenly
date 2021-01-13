<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Screeenly\Models\ApiKey;
use Screeenly\Models\User;

class DashboardTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_loads_dashboard_for_logged_in_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
                ->visit('/dashboard')
                ->see('Dashboard');
    }

    /** @test */
    public function it_redirects_logged_in_user_to_dashboard_route()
    {
        $user = User::factory()->create();

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
        $user = User::factory()->create(['email' => '']);

        $this->actingAs($user)
                ->visit('/dashboard')
                ->seePageIs('setup/email')
                ->see("You're account doesn't have an email address yet.");
    }

    /** @test */
    public function it_does_not_user_to_setup_email_page_if_account_has_an_email_address()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
                ->visit('/')
                ->seePageIs('dashboard')
                ->see('Dashboard');
    }

    /** @test */
    public function it_shows_message_if_user_reached_limit_of_active_api_key()
    {
        $user = User::factory()->create();
        $apiKeys = ApiKey::factory()->count(10)->create(['user_id' => $user->id]);

        $this->actingAs($user)
                ->visit('/')
                ->seePageIs('dashboard')
                ->see("You've reached the limit of active API keys.");
    }
}
