<?php

    return [

        /*
         * Path where generated screenshots are stored
         */

        'storage_path' => env('SCREEENLY_STORAGE_PATH', 'images/generated/'),

        'ratelimit' => [

            /*
             * Amount of API request a single client can make
             */
            'requests' => env('SCREEENLY_RATE_LIMIT', 1000),

            /*
             * Amount of minutes till the request limit is set back to 0
             */
            'time' => env('SCREEENLY_RATE_LIMIT_TIME=60', 60),

        ],

    ];
