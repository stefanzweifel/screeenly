<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmailAuthRegisterTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_shows_register_form()
    {
        $this->visit('/register');
    }

    /** @test */
    public function it_throws_error_if_email_already_exists()
    {
        $this->visit('/register');
    }

    /** @test */
    public function it_throws_error_if_password_does_not_match()
    {
        // it throws error if password does not match
    }

    /** @test */
    public function it_displays_forgot_password_link()
    {
        // it displays forgot password link
    }
}
