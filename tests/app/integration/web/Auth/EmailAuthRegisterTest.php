<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Screeenly\Models\User;
use Tests\TestCase;

class EmailAuthRegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_loads_register_view()
    {
        $response = $this->get('/register');

        $response->assertOk();
    }

    /** @test */
    public function it_shows_error_if_email_has_already_been_taken()
    {
        $user = User::factory()->create();

        $response = $this->post('/register', [
            'name' => 'foo',
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors([
            'email' => 'The email has already been taken.'
        ]);
    }

    /** @test */
    public function it_registers_new_user_and_redirects_him_to_dashboard()
    {
        $response = $this->post('/register', [
            'name' => 'foo',
            'email' => 'foo@domain.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('/dashboard');

        $this->assertDatabaseHas('users', [
            'email' => 'foo@domain.com',
        ]);
    }

    /** @test */
    public function it_throws_error_if_password_does_not_match()
    {
        $response = $this->post('/register', [
            'name' => 'foo',
            'email' => 'foo@domain.com',
            'password' => 'password',
            'password_confirmation' => 'password_not_match',
        ]);

        $response->assertSessionHasErrors([
            'password',
        ]);
    }
}
