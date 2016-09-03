<?php

namespace App\Http\Controllers\OAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Contracts\Factory as Socialite;

class GithubController extends Controller
{
    /**
     * @var Laravel\Socialite\Contracts\Factory
     */
    protected $socialite;

    /**
     * @var App\Models\User
     */
    protected $user;

    public function __construct(Socialite $socialite, User $user)
    {
        $this->socialite = $socialite;
        $this->user      = $user;
    }

    /**
     * Redirect User to Github to approve OAuth Handshake
     * @return Redirect
     */
    public function redirect()
    {
        return $this->socialite->driver('github')->scopes(['user:email'])->redirect();
    }

    /**
     * Handle Return Request from Github OAuth API
     * If the user already exists, log  in;
     * If not, create a new user
     * @return Redirect
     */
    public function handle()
    {
        $user = $this->socialite->driver('github')->user();

        if ($this->user->githubUserExists($user->id)) {

            $user = $this->user->getByProviderId($user->id);

            auth()->login($user);

            return redirect('dashboard');
        }

        if (is_null($user->email)) {

            // Redirect User to special page to enter his Email Address
            // Store Response from Github in Session

            return redirect()->route('setup.email.create', [
                'provider_id' => $user->id,
                'token' => $user->token
            ]);

        }

        $user = $this->user->createNewUserFromGithub($user);

        auth()->login($user);

        return redirect('dashboard');
    }
}
