<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Channel;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Channel::class, function (Faker $faker) {

    $image = \App\Image::all()->random(1)->first();
    $creator = \App\User::all()->random(1)->first();

    return [
        'name' => Str::random(10),
        'title' => $faker->word,
        'description' => $faker->sentence,
        'rules' => $faker->text,
        // FKs
        'image_id' => $image->id,
        'creator_id' => $creator->id,
    ];
});
