<?php namespace Screeenly\Http\Controllers;

use Screeenly\Http\Requests;
use Screeenly\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Screeenly\User;
use Screeenly\Services\RegisterUserService;

use Auth, Redirect;

class OAuthController extends Controller {

	public function redirectToProvider()
	{
	    return \Socialize::with('github')->scopes(['public'])->redirect();
	}

	public function handleProviderCallback()
	{
		$response = \Socialize::with('github')->user();
		$user     = User::where('provider_id', '=', $response->id)->first();

	    if (!$user) {

	        $userService = new RegisterUserService();

	        $user = $userService->register(
	        	$response->token,
	        	'Github',
	        	$response->id,
	        	$response->getEmail()
	        );

	    }

        Auth::login($user);
        return Redirect::to('/dashboard');
	}

	public function logout()
	{
        Auth::logout();
        return Redirect::to('/');
	}

}
