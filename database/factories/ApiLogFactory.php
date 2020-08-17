<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Screeenly\Models\ApiKey;
use Screeenly\Models\ApiLog;
use Screeenly\Models\User;

$factory->define(ApiLog::class, function (Faker $faker) {
    $user = factory(User::class)->create();

    $imagePath = storage_path('app/public');

    return [
        'user_id' => $user,
        'api_key_id' => factory(ApiKey::class)->create(['user_id' => $user->id])->id,
        'images' => $faker->image($imagePath, $width = 640, $height = 480),
    ];
});
