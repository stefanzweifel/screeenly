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
];
