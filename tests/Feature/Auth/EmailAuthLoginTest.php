<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Screeenly\Models\User;
use Tests\TestCase;

class EmailAuthLoginTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_shows_login_form()
    {
        $response = $this->get('/login');

        $response->assertOk();
    }

    #[Test]
    public function it_displays_forgot_password_link()
    {
        $response = $this->get('/login');

        $response->assertSee('Forgot Your Password?');
    }

    #[Test]
    public function it_throws_error_if_email_or_password_does_not_match()
    {
        $response = $this->post('/login', [
            'email' => 'foo@bar.com',
            'password' => 'password1234'
        ]);

        $response->assertSessionHasErrors([
            'email'
        ]);
    }

    #[Test]
    public function it_lets_user_login_with_email_and_password()
    {
        User::factory()->create([
            'email' => 'foo@bar.com'
        ]);

        $response = $this->post('/login', [
            'email' => 'foo@bar.com',
            'password' => 'password'
        ]);

        $response->assertRedirect('/dashboard');
    }
}
