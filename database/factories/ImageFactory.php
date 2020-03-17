<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {

    // TODO: Filesystem structure

    $dir = 'public/storage/images';
    $width = 640;
    $height = 480;
    $imagePath = $faker->image($dir, $width, $height, null, true, false);

    return [
        'type' => "jpg",
        'size' => $width . "x" . $height,
        'location' => $imagePath,
        'caption' => $faker->sentence,
    ];
});
