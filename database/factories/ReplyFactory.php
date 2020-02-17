<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reply;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {

    $user = \App\User::all()->random(1)->first();
    $post = \App\Post::all()->random(1)->first();

    return [
        'content' => $faker->text,
        // FKs
        'user_id' => $user->id,
        'post_id' => $post->id,
    ];
});
