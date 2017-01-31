<?php

use Screeenly\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmailAuthLoginTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_shows_login_form()
    {
        $this->visit('/login');
    }

    /** @test */
    public function it_displays_forgot_password_link()
    {
        $this->visit('/login')
            ->see('Forgot Your Password?')
            ->click('Forgot Your Password?')
            ->seePageIs('password/reset')
            ->see('Send Password Reset Link');
    }

    /** @test */
    public function it_throws_error_if_email_or_password_does_not_match()
    {
        $this->visit('/login')
            ->type('foo@bar.com', 'email')
            ->type('Password1234', 'password')
            ->press('Login')
            ->seePageIs('/login')
            ->see('These credentials do not match our records.');
    }

    /** @test */
    public function it_lets_user_login_with_email_and_password()
    {
        factory(User::class)->create([
            'email' => 'foo@bar.com',
            'password' => bcrypt('Password1234'),
        ]);

        $this->visit('/login')
            ->type('foo@bar.com', 'email')
            ->type('Password1234', 'password')
            ->press('Login')
            ->seePageIs('/dashboard?login-email')
            ->see('Documentation')
            ->see('Logout');
    }
}
