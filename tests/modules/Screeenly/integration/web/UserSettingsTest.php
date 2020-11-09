<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Screeenly\Models\ApiKey;
use Screeenly\Models\User;

class UserSettingsTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    public function login($override = [])
    {
        return $this->actingAs(factory(User::class)->create($override));
    }

    /** @test */
    public function it_loads_settings_page()
    {
        $this->login()
            ->visit('/settings')
            ->see('Settings');
    }

    /** @test */
    public function it_shows_form_to_update_email_address()
    {
        $this->login()
            ->visit('/settings')
            ->see('Account');
    }

    /** @test */
    public function it_updates_email_address_without_errors()
    {
        $this->login(['email' => 'test@bar.com'])
            ->visit('/settings')
            ->type('foo@bar.com', 'email')
            ->press('Update Account')
            ->seePageIs('/settings')
            ->see('Account updated.');

        $this->seeInDatabase('users', [
            'email' => 'foo@bar.com',
        ]);
    }

    /** @test */
    public function it_shows_error_message_if_email_address_is_already_in_use()
    {
        factory(User::class)->create(['email' => 'foo@bar.com']);

        $this->login(['email' => 'test@bar.com'])
            ->visit('/settings')
            ->type('foo@bar.com', 'email')
            ->press('Update Account')
            ->seePageIs('/settings')
            ->see('already been taken');

        $this->seeInDatabase('users', [
            'email' => 'test@bar.com',
        ]);
    }

    /** @test */
    public function it_lets_user_delete_his_account()
    {
        $this->login()->visit('/settings')
            ->see('Close Account');
    }

    /** @test */
    public function it_deletes_account()
    {
        $this->login()->visit('/settings')
            ->press('Close Account')
            ->seePageIs('/')
            ->see('Login');
    }

    /** @test */
    public function it_deletes_account_and_all_api_keys()
    {
        $user = factory(User::class)->create();
        $apiKeys = factory(ApiKey::class, 5)->create(['user_id' => $user->id]);

        $this->actingAs($user)->visit('/settings')
            ->press('Close Account')
            ->seePageIs('/')
            ->see('Login');

        $this->assertEquals(0, ApiKey::whereIn('id', $apiKeys->pluck('id')->toArray())->count());
        // $this->assertEquals(0, User::whereEmail($user->email)->count());
    }
}
