<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    
    $user = \App\User::all()->random(1)->first();
    $channel = \App\Channel::all()->random(1)->first();

    return [
        'content' => $faker->text,
        // FKs
        'user_id' => $user->id,
        'channel_id' => $channel->id,
    ];
});
