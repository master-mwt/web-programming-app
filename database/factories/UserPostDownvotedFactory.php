<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserPostDownvoted;
use Faker\Generator as Faker;

$factory->define(UserPostDownvoted::class, function (Faker $faker) {

    $user = \App\User::all()->random(1)->first();
    $post = \App\Post::all()->random(1)->first();

    return [
        // FKs
        'user_id' => $user->id,
        'post_id' => $post->id,
    ];
});
