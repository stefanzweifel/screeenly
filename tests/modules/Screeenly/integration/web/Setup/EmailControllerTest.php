<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Screeenly\Models\User;

class EmailControllerTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    public function createUserWithoutEmail()
    {
        return factory(User::class)->create(['email' => '']);
    }

    /** @test */
    public function it_loads_view()
    {
        $this->actingAs($this->createUserWithoutEmail())
                ->visit('/setup/email');
    }

    /** @test */
    public function it_throws_validation_error_if_email_adress_already_exists()
    {
        factory(User::class)->create(['email' => 'foo@bar.com']);

        $this->actingAs($this->createUserWithoutEmail())
                ->visit('/setup/email')
                ->type('foo@bar.com', 'email')
                ->press('Update Account')
                ->seePageIs('/setup/email')
                ->see('The email has already been taken');
    }

    /** @test */
    public function it_stores_email_adress_and_redirects_to_dashboard()
    {
        $this->actingAs($this->createUserWithoutEmail())
                ->visit('/setup/email')
                ->type('foo@bar.com', 'email')
                ->press('Update Account')
                ->seePageIs('/dashboard');
    }
}
