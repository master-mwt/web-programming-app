<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reply;
use Faker\Generator as Faker;
use \DavidBadura\FakerMarkdownGenerator\FakerProvider;

$factory->define(Reply::class, function (Faker $faker) {
    $faker->addProvider(new FakerProvider($faker));

    $post = \App\Post::all()->random(1)->first();
    $user_channel_role = \App\UserChannelRole::where('channel_id', $post->channel_id)->get()->random(1)->first();
    $user = \App\User::where('id', $user_channel_role->user_id)->first();

    $markdownText = $faker->markdownH3()."\n".$faker->markdownCode(100)."\n".$faker->markdownInlineBold()."<br/>".$faker->markdownInlineItalic()."<br/>".$faker->markdownInlineLink()."\n".$faker->markdownBulletedList()."\n".$faker->markdownNumberedList()."\n\n".$faker->markdownBlockqoute();

    return [
        'content' => $markdownText,
        'upvote' => 0,
        'downvote' => 0,
        // FKs
        'user_id' => $user->id,
        'post_id' => $post->id,
        'channel_id' => $post->channel_id,
    ];
});
