<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserReported;
use Faker\Generator as Faker;

$factory->define(UserReported::class, function (Faker $faker) {

    $creator_role = \App\Role::where('name', 'creator')->first()->id;
    $user_channel_role = \App\UserChannelRole::where('role_id', '!=', $creator_role)->get()->random(1)->first();
    $user = \App\User::where('id', $user_channel_role->user_id)->first();
    $channel = \App\Channel::where('id', $user_channel_role->channel_id)->first();

    return [
        // FKs
        'user_id' => $user->id,
        'channel_id' => $channel->id,
    ];
});
