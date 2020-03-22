<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use \DavidBadura\FakerMarkdownGenerator\FakerProvider;

$factory->define(Post::class, function (Faker $faker) {
    $faker->addProvider(new FakerProvider($faker));

    $user = \App\User::all()->random(1)->first();
    $channel = \App\Channel::all()->random(1)->first();

    return [
        'title' => $faker->sentence,
        'content' => $faker->markdown(),
        'upvote' => $faker->numberBetween(0,50),
        'downvote' => $faker->numberBetween(0,50),
        // FKs
        'user_id' => $user->id,
        'channel_id' => $channel->id,
    ];
});
