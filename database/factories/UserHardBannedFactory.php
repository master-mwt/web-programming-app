<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserHardBanned;
use Faker\Generator as Faker;

$factory->define(UserHardBanned::class, function (Faker $faker) {

    $user = \App\User::all()->random(1)->first();

    return [
        // FKs
        'user_id' => $user->id,
    ];
});
