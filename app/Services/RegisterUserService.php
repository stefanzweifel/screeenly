<?php

namespace Screeenly\Services;

use Screeenly\User;

class RegisterUserService
{
    public function register($code, $provider, $providerId, $email = '')
    {
        $data = [
            'email' => $email,
            'token' => $code,
            'api_key' => str_random(50),
            'plan' => 0,
            'provider_id' => $providerId,
            'provider' => $provider,
        ];

        $user = User::create($data);

        \Slack::send('A new user has registered.');

        return $user;
    }
}
