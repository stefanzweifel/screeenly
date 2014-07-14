<?php

class OAuthController extends BaseController {

    /**
     * Handle OAuth with Github
     * @return void
     */
    public function authorize_github(){

        if (Auth::check())
        {
            return Redirect::to('/dashboard');
        }

        // get data from input
        $code = Input::get( 'code' );

        // get github service
        $githubService = OAuth::consumer( 'GitHub' );


        // if code is provided get user data and sign in
        if ( !empty( $code ) ) {

            // This was a callback request from github, get the token
            $token       = $githubService->requestAccessToken( $code );
            $result      = json_decode($githubService->request('user'), true);

            $email       = $result['email'];
            $provider_id = $result['id'];
            $user        = User::where('provider_id', '=', $provider_id)->first();

            //User exists
            if(!$user)
            {

                //Create User
                $data = [
                    'email'       => $email,
                    'token'       => $code,
                    'api_key'     => Str::random(50),
                    'plan'        => 0,
                    'provider_id' => $provider_id,
                    'provider'    => 'Github'
                ];

                $user = User::create($data);
                Slack::sendMessage('A new user has registered.');

            }

            Auth::login($user);
            return Redirect::to('/dashboard');

        }
        // if not ask for permission first
        else {
            // get githubService authorization
            $url = $githubService->getAuthorizationUri();

            // return to Github login url
            return Redirect::to( (string)$url );
        }

    }

    /**
     * Logout User
     * @return void
     */
    public function logout()
    {

        Auth::logout();
        return Redirect::to('/');

    }

}
