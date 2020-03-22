<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reply;
use Faker\Generator as Faker;
use \DavidBadura\FakerMarkdownGenerator\FakerProvider;

$factory->define(Reply::class, function (Faker $faker) {
    $faker->addProvider(new FakerProvider($faker));

    $user = \App\User::all()->random(1)->first();
    $post = \App\Post::all()->random(1)->first();

    return [
        'title' => $faker->sentence,
        'content' => $faker->markdown(),
        'upvote' => $faker->numberBetween(0,50),
        'downvote' => $faker->numberBetween(0,50),
        // FKs
        'user_id' => $user->id,
        'post_id' => $post->id,
    ];
});
