<?php

use Screeenly\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmailAuthRegisterTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_loads_register_view()
    {
        $this->visit('register')
            ->assertResponseOk();
    }

    /** @test */
    public function it_shows_error_if_email_has_already_been_taken()
    {
        $user = factory(User::class)->create();

        $this->visit('register')
            ->type('foo', 'name')
            ->type($user->email, 'email')
            ->type('Password1234', 'password')
            ->type('Password1234', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/register')
            ->see('The email has already been taken.');
    }

    /** @test */
    public function it_registers_new_user_and_redirects_him_to_dashboard()
    {
        $this->visit('register')
            ->type('foo', 'name')
            ->type('foo@domain.com', 'email')
            ->type('Password1234', 'password')
            ->type('Password1234', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/dashboard')
            ->see('Logout');

        $this->seeInDatabase('users', [
            'email' => 'foo@domain.com',
        ]);
    }

    /** @test */
    public function it_throws_error_if_password_does_not_match()
    {
        $this->visit('register')
            ->type('foo', 'name')
            ->type('foo@bar.com', 'email')
            ->type('Password1234', 'password')
            ->type('SomethingElse', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/register')
            ->see('The Password Confirmation does not match.');
    }
}
