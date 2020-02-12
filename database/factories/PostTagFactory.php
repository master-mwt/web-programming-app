<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PostTag;
use Faker\Generator as Faker;

$factory->define(PostTag::class, function (Faker $faker) {
    
    $post = \App\Post::all()->random(1)->first();
    $tag = \App\Tag::all()->random(1)->first();
    
    return [
        // FKs
        'post_id' => $post->id,
        'tag_id' => $tag->id,
    ];
});
