<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Screeenly\Models\ApiKey;
use Screeenly\Models\User;
use Tests\TestCase;

class ApiKeyTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_lists_api_keys_a_user_created()
    {
        $user = User::factory()->create();
        ApiKey::factory()->create([
            'user_id' => $user->id,
            'name' => 'This is my test API Key',
        ]);

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertSee('This is my test API Key');
    }

    #[Test]
    public function it_shows_message_if_no_api_keys_exists()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertSee("You currently don't have any API keys.", false);
    }

    #[Test]
    public function it_lets_user_create_a_new_api_key()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertSee('Name for your new API Key');

        $this->actingAs($user)
            ->from('/dashboard')
            ->followingRedirects()
            ->post('/apikeys', ['name' => 'FooBar'])
            ->assertSee('Your new API Key has been created.');

        $this->assertDatabaseHas('api_keys', [
            'name' => 'FooBar',
            'user_id' => $user->id,
        ]);
    }

    #[Test]
    public function it_lets_user_delete_an_api_key()
    {
        $user = User::factory()->create();
        $apiKey = ApiKey::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->from('/dashboard')
            ->followingRedirects()
            ->delete("/apikeys/{$apiKey->id}")
            ->assertSee('API Key destroyed.');

        $this->assertNull(ApiKey::find($apiKey->id));
    }
}
