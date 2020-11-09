<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Screeenly\Models\ApiKey;
use Screeenly\Models\User;

$factory->define(ApiKey::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'key' => Str::random(10),
        'user_id' => factory(User::class)->create()->id,
    ];
});
