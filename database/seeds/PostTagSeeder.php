<?php

use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        global $results;
        $results = [];

        factory(App\PostTag::class, 100)->make()->each(function($post_tag) {

            global $results;

            $block = [
                'post_id' => $post_tag->post_id,
                'tag_id' => $post_tag->tag_id,
            ];

            if(empty($results)) {
                array_push($results, $block);
            }

            $guard = false;
            foreach($results as $elem) {
                if($elem !== $block && $guard == false) {
                    continue;
                } else {
                    $guard = true;
                    break;
                }
            }

            if($guard == false) {
                array_push($results, $block);
            }
        });

        foreach($results as $result) {
            App\PostTag::create($result);
        }
    }
}
