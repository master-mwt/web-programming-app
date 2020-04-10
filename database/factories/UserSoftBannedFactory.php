<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserSoftBanned;
use Faker\Generator as Faker;

$factory->define(UserSoftBanned::class, function (Faker $faker) {

    $user = \App\User::all()->random(1)->first();
    $channel = \App\Channel::all()->random(1)->first();

    return [
        // FKs
        'user_id' => $user->id,
        'channel_id' => $channel->id,
    ];
});
