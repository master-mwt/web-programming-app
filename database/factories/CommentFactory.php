<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;
use \DavidBadura\FakerMarkdownGenerator\FakerProvider;

$factory->define(Comment::class, function (Faker $faker) {
    // $faker->addProvider(new FakerProvider($faker));

    $reply = \App\Reply::all()->random(1)->first();
    $user_channel_role = \App\UserChannelRole::where('channel_id', $reply->channel_id)->get()->random(1)->first();
    $user = \App\User::where('id', $user_channel_role->user_id)->first();

    return [
        'content' => $faker->text,
        // FKs
        'user_id' => $user->id,
        'reply_id' => $reply->id,
        'channel_id' => $reply->channel_id,
    ];
});
