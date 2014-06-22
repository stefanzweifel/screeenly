<?php


    return array(

    'connections' => array(

        'mysql' => array(
            'driver'    => 'mysql',
            'host'      => $_ENV['db_host'],
            'database'  => $_ENV['db_name'],
            'username'  => $_ENV['db_user'],
            'password'  => $_ENV['db_pass'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        )

    ),


    );

