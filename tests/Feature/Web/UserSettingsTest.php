<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Screeenly\Models\ApiKey;
use Screeenly\Models\User;
use Tests\TestCase;

class UserSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function login($override = [])
    {
        return $this->actingAs(User::factory()->create($override));
    }

    #[Test]
    public function it_loads_settings_page()
    {
        $this->login()
            ->get('/settings')
            ->assertOk()
            ->assertSee('Settings');
    }

    #[Test]
    public function it_shows_form_to_update_email_address()
    {
        $this->login()
            ->get('/settings')
            ->assertSee('Account')
            ->assertSee('Update Account');
    }

    #[Test]
    public function it_updates_email_address_without_errors()
    {
        $this->login(['email' => 'test@bar.com'])
            ->from('/settings')
            ->followingRedirects()
            ->post('/settings', ['email' => 'foo@bar.com'])
            ->assertSee('Account updated.');

        $this->assertDatabaseHas('users', [
            'email' => 'foo@bar.com',
        ]);
    }

    #[Test]
    public function it_shows_error_message_if_email_address_is_already_in_use()
    {
        User::factory()->create(['email' => 'foo@bar.com']);

        $this->login(['email' => 'test@bar.com'])
            ->from('/settings')
            ->followingRedirects()
            ->post('/settings', ['email' => 'foo@bar.com'])
            ->assertSee('already been taken');

        $this->assertDatabaseHas('users', [
            'email' => 'test@bar.com',
        ]);
    }

    #[Test]
    public function it_lets_user_delete_his_account()
    {
        $this->login()
            ->get('/settings')
            ->assertSee('Close Account');
    }

    #[Test]
    public function it_deletes_account()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->followingRedirects()
            ->delete('/settings/account')
            ->assertSee('Login');

        $this->assertGuest();
    }

    #[Test]
    public function it_deletes_account_and_all_api_keys()
    {
        $user = User::factory()->create();
        $apiKeys = ApiKey::factory()->count(5)->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->followingRedirects()
            ->delete('/settings/account')
            ->assertSee('Login');

        $this->assertEquals(0, ApiKey::whereIn('id', $apiKeys->pluck('id')->toArray())->count());
    }
}
