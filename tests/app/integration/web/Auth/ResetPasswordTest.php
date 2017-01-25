<?php

use Screeenly\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ResetPasswordTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_shows_form_to_send_reset_password_request()
    {
        $this->visit('/password/reset');
    }

    /** @test */
    public function it_redirects_user_to_dashboard_if_they_try_to_reset_their_password_if_they_are_logged_in()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/password/reset')
            ->seePageIs('/dashboard');
    }
}
