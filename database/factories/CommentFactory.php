<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;
use \DavidBadura\FakerMarkdownGenerator\FakerProvider;

$factory->define(Comment::class, function (Faker $faker) {
    // $faker->addProvider(new FakerProvider($faker));

    $user = \App\User::all()->random(1)->first();
    $reply = \App\Reply::all()->random(1)->first();

    return [
        'content' => $faker->text,
        // FKs
        'user_id' => $user->id,
        'reply_id' => $reply->id,
        'channel_id' => $reply->channel_id,
    ];
});
