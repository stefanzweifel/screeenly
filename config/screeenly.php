<?php

return [

    /*
     * Disable Chrome Sandbox
     * See https://github.com/stefanzweifel/screeenly/issues/174#issuecomment-423438612
     */
    'disable_sandbox' => env('SCREEENLY_DISABLE_SANDBOX', false),

    /**
     * The Filesystem disk where screenshots are being stored
     */
    'filesystem_disk' => env('SCREEENLY_DISK', 'public'),


    'use_aws_lambda_browser' => env('SCREEENLY_USE_AWS_LAMBDA_BROWSER', false),

    /*
     * Date after which new user registrations are blocked.
     */
    'dusk_date' => '2026-07-01',

    /*
     * Date after which all API requests are blocked.
     */
    'sunset_date' => '2026-08-21',
];
