<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Screeenly\Models\User;

class UserTest extends BrowserKitTestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_returns_true_if_github_user_exists_in_our_database()
    {
        $providerId = 123456;

        $user = User::factory()->create(['provider_id' => $providerId]);

        $this->assertEquals(true, User::githubUserExists($providerId));
    }

    /** @test */
    public function it_returns_false_if_github_user_does_not_exist_in_our_database()
    {
        $providerId = 123456;

        $user = User::factory()->create();

        $this->assertEquals(false, User::githubUserExists($providerId));
    }

    /** @test */
    public function it_returns_user_when_provider_id_is_provided()
    {
        $providerId = 123456;

        $user = User::factory()->create(['provider_id' => $providerId]);

        $this->assertEquals($user->id, User::getByProviderId($providerId)->id);
    }

    /** @test */
    public function it_throws_exception_if_no_user_for_given_provider_id_could_be_found()
    {
        $this->expectException(Illuminate\Database\Eloquent\ModelNotFoundException::class);

        $providerId = 123456;

        $user = User::factory()->create();
        $searchedUser = User::getByProviderId($providerId);
    }

    /** @test */
    public function it_creates_new_user_from_socialite_user_object()
    {
        $stub = $this->createMock(Laravel\Socialite\Two\User::class);
        $stub->id = 2;
        $stub->email = 'foo@bar.com';

        $user = User::createNewUserFromGithub($stub->email, $stub->id);

        $this->assertEquals(2, $user->provider_id);
        $this->assertEquals('foo@bar.com', $user->email);
    }

    /** @test */
    public function it_throws_an_error_if_it_no_email_is_given_from_socialite()
    {
        $this->expectException(PDOException::class);

        $stub = $this->createMock(Laravel\Socialite\Two\User::class);
        $stub->id = 2;

        $user = User::createNewUserFromGithub($stub->email, $stub->id);
    }
}
