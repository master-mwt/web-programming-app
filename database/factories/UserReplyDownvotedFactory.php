<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserReplyDownvoted;
use Faker\Generator as Faker;

$factory->define(UserReplyDownvoted::class, function (Faker $faker) {

    $user = \App\User::all()->random(1)->first();
    $reply = \App\Reply::all()->random(1)->first();

    return [
        // FKs
        'user_id' => $user->id,
        'reply_id' => $reply->id,
    ];
});
