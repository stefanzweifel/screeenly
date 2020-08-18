<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Screeenly\Models\ApiKey;
use Screeenly\Models\User;

class ApiKeyTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    public function login($override = [])
    {
        return $this->actingAs(factory(User::class)->create($override));
    }

    /** @test */
    public function it_lists_api_keys_a_user_created()
    {
        $user = factory(User::class)->create();
        $apiKey = factory(ApiKey::class)->create([
            'user_id' => $user->id,
            'name' => 'This is my test API Key',
        ]);

        $this->actingAs($user)
            ->visit('/dashboard')
            ->see('This is my test API Key');
    }

    /** @test */
    public function it_shows_message_if_no_api_keys_exists()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/dashboard')
            ->see("You currently don't have any API keys.");
    }

    /** @test */
    public function it_lets_user_create_a_new_api_key()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/dashboard')
            ->see('Name for your new API Key')
            ->type('FooBar', 'name')
            ->press('Create API Key')
            ->seePageIs('/dashboard')
            ->see('Your new API Key has been created.');

        $this->seeInDatabase('api_keys', [
            'name' => 'FooBar',
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function it_lets_user_delete_an_api_key()
    {
        $user = factory(User::class)->create();
        $apiKey = factory(ApiKey::class)->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->visit('/dashboard')
            ->press('Delete')
            ->seePageIs('/dashboard')
            ->see('API Key destroyed.');

        $this->assertNull(ApiKey::find($apiKey->id));
    }
}
