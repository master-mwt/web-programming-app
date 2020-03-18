<?php

use Illuminate\Database\Seeder;
use App\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Image::class, 3)->make()->each(function($image) {

            $row = [
                'type' => $image->type,
                'size' => $image->size,
                'location' => $image->location,
                'caption' => $image->caption,
            ];

            if($image->location){
                Image::create($row);
            }

        });
    }
}
