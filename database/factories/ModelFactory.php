<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Screeenly\User::class, function ($faker) {
    return [
        'email'       => $faker->email,
        'token'       => str_random(10),
        'plan'        => 0,
        'provider'    => 'Github',
        'provider_id' => $faker->randomNumber
    ];
});

$factory->define(Screeenly\ApiKey::class, function ($faker) {
    return [
        'name'    => $faker->sentence(3),
        'key'     => str_random(40)
    ];
});
