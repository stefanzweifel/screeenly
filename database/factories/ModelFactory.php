<?php

use Illuminate\Support\Str;
use Screeenly\Models\User;
use Screeenly\Models\ApiKey;
use Screeenly\Models\ApiLog;

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

$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [

        'email' => $faker->safeEmail,
        'token' => Str::random(15),
        'provider' => 'Github',
        'provider_id' => $faker->randomNumber(7),

        // Auth Stuff
        'name' => $faker->name,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => Str::random(10),
    ];
});

$factory->define(ApiKey::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'key' => Str::random(10),
        'user_id' => factory(User::class)->create()->id,
    ];
});
$factory->define(ApiLog::class, function (Faker\Generator $faker) {
    $user = factory(User::class)->create();

    $imagePath = storage_path('app/public');

    return [
        'user_id' => $user,
        'api_key_id' => factory(ApiKey::class)->create(['user_id' => $user->id])->id,
        'images' => $faker->image($imagePath, $width = 640, $height = 480),
    ];
});
