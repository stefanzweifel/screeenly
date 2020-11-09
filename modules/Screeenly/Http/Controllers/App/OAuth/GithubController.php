<?php

namespace Screeenly\Http\Controllers\App\OAuth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Screeenly\Models\User;

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
        $this->user = $user;
    }

    /**
     * Redirect User to Github to approve OAuth Handshake.
     * @return Redirect
     */
    public function redirect()
    {
        return $this->socialite->driver('github')->scopes(['user:email'])->redirect();
    }

    /**
     * Handle Return Request from Github OAuth API
     * If the user already exists, log  in;
     * If not, create a new user.
     * @return Redirect
     */
    public function handle()
    {
        $user = $this->socialite->driver('github')->user();

        if ($this->user->githubUserExists($user->id)) {
            $user = $this->user->getByProviderId($user->id);

            auth()->login($user);

            return redirect()->route('app.dashboard');
        }

        if (is_null($user->email)) {

            // Redirect User to special page to enter his Email Address
            // Store Response from Github in Session

            return redirect()->route('setup.email.create', [
                'provider_id' => $user->id,
            ]);
        }

        $user = $this->user->createNewUserFromGithub($user->email, $user->id);

        auth()->login($user);

        return redirect()->route('app.dashboard');
    }
}
