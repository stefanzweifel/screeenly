<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Laravel\Socialite\Two\GithubProvider;
use Laravel\Socialite\Two\User as SocialiteUser;
use PHPUnit\Framework\Attributes\Test;
use Screeenly\Models\User;
use Tests\TestCase;

class GithubOAuthLoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Mock the Socialite Factory, so we can hijack the OAuth Request.
     * @param  string  $email
     * @param  string  $token
     * @param  int $id
     * @return void
     */
    public function mockSocialiteFacade($email = 'foo@bar.com', $token = 'foo', $id = 1)
    {
        $socialiteUser = $this->createStub(SocialiteUser::class);
        $socialiteUser->token = $token;
        $socialiteUser->id = $id;
        $socialiteUser->email = $email;

        $provider = $this->createStub(GithubProvider::class);
        $provider->method('user')
            ->willReturn($socialiteUser);

        $stub = $this->createStub(Socialite::class);
        $stub->method('driver')
            ->willReturn($provider);

        // Replace Socialite Instance with our mock
        $this->app->instance(Socialite::class, $stub);
    }

    #[Test]
    public function it_redirects_to_github()
    {
        $response = $this->get('/oauth/github/redirect');

        $response->assertRedirectContains('github.com/login/oauth');
    }

    #[Test]
    public function it_retrieves_github_request_and_creates_a_new_user()
    {
        $this->mockSocialiteFacade();

        $this->get('/oauth/github/handle')
            ->assertRedirect('/dashboard');

        $this->assertDatabaseHas('users', [
            'email' => 'foo@bar.com',
        ]);
    }

    #[Test]
    public function it_retrieves_github_request_and_login_existing_user()
    {
        $user = User::factory()->create();

        $this->mockSocialiteFacade($user->email, $user->token, $user->provider_id);

        $this->get('/oauth/github/handle')
            ->assertRedirect('/dashboard');

        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function it_redirects_user_with_out_email_address_to_setup_page()
    {
        $this->mockSocialiteFacade(null, 'secret_token', '12345');

        $this->get('/oauth/github/handle')
            ->assertRedirect('/setup/email?provider_id=12345');
    }
}
