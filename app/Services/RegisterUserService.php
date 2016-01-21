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
            'plan' => 0,
            'provider_id' => $providerId,
            'provider' => $provider,
        ];

        $user = User::create($data);

        \Slack::send('A new user has registered.');

        return $user;
    }
}
