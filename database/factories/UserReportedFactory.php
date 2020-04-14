<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserReported;
use Faker\Generator as Faker;

$factory->define(UserReported::class, function (Faker $faker) {

    $creator_role = \App\Role::where('name', 'creator')->first()->id;
    $member_role = \App\Role::where('name', 'member')->first()->id;

    $user_channel_role_not_creator = \App\UserChannelRole::where('role_id', '!=', $creator_role)->get()->random(1)->first();
    $user = \App\User::where('id', $user_channel_role_not_creator->user_id)->first();
    $channel = \App\Channel::where('id', $user_channel_role_not_creator->channel_id)->first();

    $user_channel_role_not_member = \App\UserChannelRole::where('role_id', '!=', $member_role)->where('channel_id', $channel->id)->get()->random(1)->first();
    $reported_by = \App\User::where('id', $user_channel_role_not_member->user_id)->first();

    return [
        // FKs
        'user_id' => $user->id,
        'channel_id' => $channel->id,
        'reported_by' => $reported_by->id,
    ];
});
