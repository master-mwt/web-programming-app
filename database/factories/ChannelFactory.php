<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Channel;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Channel::class, function (Faker $faker) {
    return [
        // 'name' => $faker->word,
        'name' => Str::random(10),
    ];
});
