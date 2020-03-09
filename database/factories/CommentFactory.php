<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {

    $user = \App\User::all()->random(1)->first();
    $reply = \App\Reply::all()->random(1)->first();

    return [
        'title' => $faker->sentence,
        'content' => $faker->text,
        'upvote' => $faker->numberBetween(0,50),
        'downvote' => $faker->numberBetween(0,50),
        // FKs
        'user_id' => $user->id,
        'reply_id' => $reply->id,
    ];
});
