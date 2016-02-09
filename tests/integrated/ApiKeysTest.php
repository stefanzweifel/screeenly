<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Screeenly\ApiKey;
use Screeenly\User;

class ApiKeysTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /** @test */
    public function it_adds_new_api_key_to_my_account()
    {
        $this->beUser();

        $this->visit('/')
            ->type('Foo', 'name')
            ->press('Create key')
            ->seePageIs('/dashboard')
            ->seeInDatabase('api_keys', [
                'name'    => 'Foo',
                'user_id' => $this->user->id,
            ]);
    }

    /** @test */
    public function it_loads_edit_view_for_my_api_key()
    {
        $this->beUser();
        $apiKey = factory(ApiKey::class)->create(['user_id' => $this->user->id]);

        $this->visit('/')->click('Edit')->see('Edit API Key');
    }

    /** @test */
    public function it_doesn_load_edit_view_for_an_api_key_with_doesnt_belong_to_me()
    {
        $this->beUser();
        $anotherUser = factory(User::class)->create();
        $myApiKey = factory(ApiKey::class, 5)->create(['user_id' => $this->user->id]);
        $otherApiKey = factory(ApiKey::class)->create(['user_id' => $anotherUser->id]);

        $this->visit("/apikeys/{$otherApiKey->id}/edit")->seePageIs('/dashboard');
    }

    /** @test */
    public function it_updates_my_api_key()
    {
        $this->beUser();
        $apiKey = factory(ApiKey::class)->create(['user_id' => $this->user->id]);

        $this->visit('/')
            ->click('Edit')
            ->type('Foo', 'name')
            ->press('Save changes')
            ->seePageIs('/dashboard')
            ->seeInDatabase('api_keys', ['name' => 'Foo']);
    }

    /** @test */
    public function it_doesnt_update_anothers_api_key()
    {
        $this->beUser();
        $anotherUser = factory(User::class)->create();
        $myApiKey = factory(ApiKey::class, 5)->create(['user_id' => $this->user->id]);
        $otherApiKey = factory(ApiKey::class)->create(['user_id' => $anotherUser->id]);

        $this->patch("/apikeys/{$otherApiKey->id}", ['name' => 'foo']);

        $this->assertResponseStatus(302);
    }

    /** @test */
    public function it_deletes_my_api_key()
    {
        $this->beUser();
        $apiKey = factory(ApiKey::class)->create(['user_id' => $this->user->id]);

        $this->visit('/')
            ->press('Delete')
            ->seePageIs('/dashboard')
            ->dontSeeInDatabase('api_keys', ['name' => $apiKey->name]);
    }

    /** @test */
    public function it_doesnt_delete_anothers_api_key()
    {
        $this->beUser();
        $anotherUser = factory(User::class)->create();
        $myApiKey = factory(ApiKey::class, 5)->create(['user_id' => $this->user->id]);
        $otherApiKey = factory(ApiKey::class)->create(['user_id' => $anotherUser->id]);

        $this->delete("/apikeys/{$otherApiKey->id}", ['name' => 'foo']);

        $this->assertResponseStatus(302);
    }
}
