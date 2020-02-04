<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Channel;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Channel::class, function (Faker $faker) {
    return [
        'name' => Str::random(10),
        'title' => $faker->word,
        'description' => $faker->sentence,
    ];
});
