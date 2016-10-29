<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ResetPasswordTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_shows_form_to_send_reset_password_request()
    {
        $this->visit('/password/reset');
    }
}
