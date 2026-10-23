<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Screeenly\Models\User;
use Tests\TestCase;

class EmailControllerTest extends TestCase
{
    use RefreshDatabase;

    public function createUserWithoutEmail()
    {
        return User::factory()->create(['email' => '']);
    }

    #[Test]
    public function it_loads_view()
    {
        $this->actingAs($this->createUserWithoutEmail())
            ->get('/setup/email')
            ->assertOk();
    }

    #[Test]
    public function it_throws_validation_error_if_email_adress_already_exists()
    {
        User::factory()->create(['email' => 'foo@bar.com']);

        $this->actingAs($this->createUserWithoutEmail())
            ->from('/setup/email')
            ->followingRedirects()
            ->post('/setup/email', ['email' => 'foo@bar.com'])
            ->assertSee('The email has already been taken');
    }

    #[Test]
    public function it_stores_email_adress_and_redirects_to_dashboard()
    {
        $this->actingAs($this->createUserWithoutEmail())
            ->post('/setup/email', ['email' => 'foo@bar.com'])
            ->assertRedirect('dashboard');
    }
}
