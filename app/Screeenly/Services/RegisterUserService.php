<?php namespace Screeenly\Services;

class RegisterUserService {

    public function register($code, $provider, $providerId)
    {
        $data = [
            // 'email'       => $email,
            'token'       => $code,
            'api_key'     => \Str::random(50),
            'plan'        => 0,
            'provider_id' => $providerId,
            'provider'    => $provider
        ];

        $user = \User::create($data);

        // $user = \User::where('email', '=', $email);

        \Slack::sendMessage('A new user has registered.');

        return $user;
    }

}