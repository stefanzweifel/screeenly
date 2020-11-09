<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Screeenly\Models\User;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_form_to_send_reset_password_request()
    {
        $response = $this->get('/password/reset');

        $response->assertOk();
    }

    /** @test */
    public function it_redirects_user_to_dashboard_if_they_try_to_reset_their_password_if_they_are_logged_in()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/password/reset');

        $response->assertRedirect('/dashboard');
    }
}
