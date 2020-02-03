<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserChannelRole;
use Faker\Generator as Faker;


$factory->define(UserChannelRole::class, function (Faker $faker) {

    $users = \App\User::all();
    $channels = \App\Channel::all();
    $roles = \App\Role::all();

    return [
        'user_id' => $users->random(1)->first()->id,
        'channel_id' => $channels->random(1)->first()->id,
        'role_id' => $roles->random(1)->first()->id,
    ];
});
