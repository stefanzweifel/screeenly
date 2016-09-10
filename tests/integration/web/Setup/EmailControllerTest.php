<?php

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EmailControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function createUser()
    {
        return factory(User::class)->create(['email' => '']);
    }

    /** @test */
    public function it_loads_view()
    {
        $this->actingAs($this->createUser())
                ->visit('/setup/email');
    }

    /** @test */
    public function it_throws_validation_error_if_email_adress_already_exists()
    {
        factory(User::class)->create(['email' => 'foo@bar.com']);

        $this->actingAs($this->createUser())
                ->visit('/setup/email')
                ->type('foo@bar.com', 'email')
                ->press('Update Account')
                ->seePageIs('/setup/email')
                ->see('The email has already been taken');
    }

    /** @test */
    public function it_stores_email_adress_and_redirects_to_dashboard()
    {
        $this->actingAs($this->createUser())
                ->visit('/setup/email')
                 ->type('foo@bar.com', 'email')
                 ->press('Update Account')
                 ->seePageIs('/dashboard');
    }
}
