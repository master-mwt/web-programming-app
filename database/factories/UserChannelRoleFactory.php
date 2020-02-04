<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserChannelRole;
use Faker\Generator as Faker;


$factory->define(UserChannelRole::class, function (Faker $faker) {

    $user = \App\User::all()->random(1)->first();
    $channel = \App\Channel::all()->random(1)->first();
    $role = \App\Role::all()->random(1)->first();

    return [
        // FKs
        'user_id' => $user->id,
        'channel_id' => $channel->id,
        'role_id' => $role->id,
    ];
});
