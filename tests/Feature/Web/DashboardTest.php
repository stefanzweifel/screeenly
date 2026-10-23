<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Screeenly\Models\ApiKey;
use Screeenly\Models\User;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_loads_dashboard_for_logged_in_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Dashboard');
    }

    #[Test]
    public function it_redirects_logged_in_user_to_dashboard_route()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/')
            ->assertRedirect('dashboard');
    }

    #[Test]
    public function it_redirects_not_logged_in_user_to_login_page()
    {
        $this->get('/dashboard')
            ->assertRedirect('login');
    }

    #[Test]
    public function it_redirects_user_to_setup_email_page_if_his_account_does_not_have_an_email_address()
    {
        $user = User::factory()->create(['email' => '']);

        $this->actingAs($user)
            ->followingRedirects()
            ->get('/dashboard')
            ->assertSee("You're account doesn't have an email address yet.", false);
    }

    #[Test]
    public function it_does_not_redirect_user_to_setup_email_page_if_account_has_an_email_address()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Dashboard');
    }

    #[Test]
    public function it_shows_message_if_user_reached_limit_of_active_api_key()
    {
        $user = User::factory()->create();
        ApiKey::factory()->count(10)->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertSee("You've reached the limit of active API keys.", false);
    }
}
