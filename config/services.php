<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => Screeenly\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'slack' => [
        'channel' => env('SLACK_CHANNEL'),
        'token'   => env('SLACK_TOKEN'),
        'bot'     => env('SLACK_BOT'),
        'domain'  => env('SLACK_DOMAIN'),
        'icon'    => env('SLACK_ICON'),
    ],

    'github' => [
        'client_id'     => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_SECRET'),
        'redirect'      => env('GITHUB_REDIRECT_URL'),
    ],

    'raven' => [
        'dsn'   => env('RAVEN_DSN'),
        'level' => env('RAVEN_LEVEL', 'debug'),
    ],

    'envoyer' => [
        'pings' => [
            'scheduler_ping_url' => env('SCHEDULER_PING_URL'),
        ],
    ],

];
