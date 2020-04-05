<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use \DavidBadura\FakerMarkdownGenerator\FakerProvider;

$factory->define(Post::class, function (Faker $faker) {
    $faker->addProvider(new FakerProvider($faker));

    $user = \App\User::all()->random(1)->first();
    $channel = \App\Channel::all()->random(1)->first();

    $markdownText = $faker->markdownH3()."\n".$faker->markdownCode(100)."\n".$faker->markdownInlineBold()."<br/>".$faker->markdownInlineItalic()."<br/>".$faker->markdownInlineLink()."\n".$faker->markdownBulletedList()."\n".$faker->markdownNumberedList();
    
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
