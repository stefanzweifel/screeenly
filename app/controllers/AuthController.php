<?php

class AuthController extends BaseController {

    /**
     * Handle OAuth with Github
     * @return Illuminate\Http\RedirectResponse
     */
    public function authorizeGithub(){

        $code   = Input::get('code');
        $github = OAuth::consumer('GitHub');

        if ( !empty( $code ) ) {

            $token       = $github->requestAccessToken( $code );
            $data        = json_decode($github->request('user'), true);
            $provider_id = $data['id'];
            $user        = User::where('provider_id', '=', $provider_id)->first();

            if ( ! $user) {

                // Disabled - See: https://github.com/stefanzweifel/screeenly/issues/11
                // if ( ! array_key_exists('email', $data)) {
                //     throw new Exception("You're Github Account doesn't have a email adress", 1);
                // }

                $userService = new Screeenly\Services\RegisterUserService();
                $user = $userService->register($code, 'Github', $provider_id);
            }

            Auth::login($user);
            return Redirect::to('/dashboard');

        }
        else {

            $url = $github->getAuthorizationUri();

            // Redirect to Github Permission Screen
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
