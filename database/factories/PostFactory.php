<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use \DavidBadura\FakerMarkdownGenerator\FakerProvider;

$factory->define(Post::class, function (Faker $faker) {
    $faker->addProvider(new FakerProvider($faker));

    $user_channel_role = \App\UserChannelRole::all()->random(1)->first();
    $user = \App\User::where('id', $user_channel_role->user_id)->first();
    $channel = \App\Channel::where('id', $user_channel_role->channel_id)->first();

    $markdownText = $faker->markdownH3()."\n".$faker->markdownCode(100)."\n".$faker->markdownInlineBold()."<br/>".$faker->markdownInlineItalic()."<br/>".$faker->markdownInlineLink()."\n".$faker->markdownBulletedList()."\n".$faker->markdownNumberedList()."\n\n".$faker->markdownBlockqoute();

    return [
        'title' => $faker->sentence,
        'content' => $markdownText,
        'upvote' => 0,
        'downvote' => 0,
        // FKs
        'user_id' => $user->id,
        'channel_id' => $channel->id,
    ];
});
