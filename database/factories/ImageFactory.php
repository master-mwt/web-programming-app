<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Image;
use Faker\Generator as Faker;

static $files = false;

$factory->define(Image::class, function (Faker $faker) {

    $rootDir = 'public/imgs/';
    $imagePath = $rootDir . $faker->randomElement(getImages($rootDir));
    $imageDetails = getimagesize($imagePath);

    $width = $imageDetails[0];
    $height = $imageDetails[1];
    $type = $imageDetails['mime'];

    return [
        'type' => $type,
        'size' => $width . "x" . $height,
        'location' => $imagePath,
        'caption' => $faker->sentence,
    ];
});

function getImages($dir){
    global $files;

    if(!$files){
        // this will be executed only once
        $scan = scandir($dir);
        $length = count($scan);
        $files = array_slice($scan, 2, $length-1, false);
    }

    return $files;
}
