<?php


class UserSettingsTest extends TestCase
{
    /** @test */
    public function it_loads_settings_page()
    {
        $this->visit('/settings');
    }

    /** @test */
    public function it_shows_form_to_update_email_address()
    {
        // it shows form to update email address
    }

    /** @test */
    public function it_updates_email_address_without_errors()
    {
        // it updates email address without errors
    }

    /** @test */
    public function it_shows_error_message_if_email_address_is_already_in_use()
    {
        //it shows error message if email address is already in use
    }

    /** @test */
    public function it_lets_user_delete_his_account()
    {
        $this->visit('/settings')
            ->see('Close Account');
    }

    /** @test */
    public function it_deletes_account_and_deletes_all_api_keys()
    {
        // it deletes account and deletes all api keys
    }
}
