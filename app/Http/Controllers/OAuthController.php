<?php

namespace Screeenly\Http\Controllers;

use Screeenly\Services\RegisterUserService;
use Screeenly\User;
use Socialize;

class OAuthController extends Controller
{
    /**
     * Redirect to Github.com to get Permission.
     *
     * @return [type] [description]
     */
    public function redirectToProvider()
    {
        return Socialize::with('github')->scopes(['user:email'])->redirect();
    }

    /**
     * Handle Response from Provider.
     *
     * @return Illuminate\Html\Redirect
     */
    public function handleProviderCallback()
    {
        $response = Socialize::with('github')->user();
        $user = User::where('provider_id', '=', $response->id)->first();

        if (!$user) {
            $userService = new RegisterUserService();

            $user = $userService->register(
                $response->token,
                'Github',
                $response->id,
                $response->getEmail()
            );
        }

        auth()->login($user);

        return redirect('/dashboard');
    }

    /**
     * Logout User.
     *
     * @return Illuminate\Html\Redirect
     */
    public function logout()
    {
        auth()->logout();
        // Auth::logout();

        return redirect('/');
    }
}
