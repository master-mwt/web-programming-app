<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Image;
use Faker\Generator as Faker;

static $files = false;

global $rootDir;
$rootDir = 'public/imgs/';

global $images;
$images = getImages($rootDir);

$factory->define(Image::class, function (Faker $faker) {

    global $rootDir;
    global $images;
    foreach ($images as $k => $image) {
        $imagePath = $rootDir . $image;
        $imageDetails = getimagesize($imagePath);

        $width = $imageDetails[0];
        $height = $imageDetails[1];
        $type = $imageDetails['mime'];

        unset($images[$k]);

        return [
            'type' => $type,
            'size' => $width . "x" . $height,
            'location' => substr($imagePath, strpos($imagePath, '/', 1)),
            'caption' => $faker->sentence,
        ];
    }
    dd("finished");
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
