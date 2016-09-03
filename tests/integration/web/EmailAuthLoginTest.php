<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmailAuthLoginTest extends TestCase
{

    /** @test */
    public function it_shows_login_form()
    {
        $this->visit('/login');
    }

    /** @test */
    public function it_throws_error_if_email_or_password_does_not_match()
    {
        // it throws error if email or password does not match
    }

    /** @test */
    public function it_lets_user_login_with_email_and_password()
    {
        // it lets user login with email and password
    }

}
