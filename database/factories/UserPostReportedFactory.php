<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserPostReported;
use Faker\Generator as Faker;

$factory->define(UserPostReported::class, function (Faker $faker) {

    $post = \App\Post::all()->random(1)->first();
    $user_channel_role = \App\UserChannelRole::where('channel_id', $post->channel_id)->get()->random(1)->first();
    $user = \App\User::where('id', $user_channel_role->user_id)->first();

    return [
        'channel_id' => $post->channel_id,
        // FKs
        'user_id' => $user->id,
        'post_id' => $post->id,
    ];
});
