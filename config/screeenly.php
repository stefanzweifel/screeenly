<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API specific settings
    |--------------------------------------------------------------------------
    |
    | The following options control how the API works. Currently you can only
    | change ratelimit settings.
    |
    */

    'api' => [

        'ratelimit' => [

            /*
             * Amount of API request a single client can make
             */
            'requests' => env('SCREEENLY_RATE_LIMIT', 1000),

            /*
             * Amount of minutes till the request limit is set back to 0
             */
            'time' => env('SCREEENLY_RATE_LIMIT_TIME', 60),

        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Core settings
    |--------------------------------------------------------------------------
    |
    | This options control the core of Screeenly. Or in other words they
    | control how screenshots are generated. Here you may change default
    | values for width, delay or storage path.
    |
    */

    'core' => [

        'path_to_phantomjs' => env('SCREEENLY_PATH_TO_PHANTOMJS', 'bin/phantomjs'),

        /*
         * Default Screenshot Width
         */
        'screenshot_width'  => 1024,

        /*
         * Folder, where screenshots are stored
         */
        'storage_path' => env('SCREEENLY_STORAGE_PATH', 'images/generated/'),

        /*
         * Delay in seconds, when a screenshot is generated
         */
        'delay' => 1,

        /*
         * Max amount of seconds, when a request should fail
         */
        'timeout' => 1000,

    ],

];
