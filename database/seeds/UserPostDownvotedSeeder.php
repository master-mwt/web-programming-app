<?php

use Illuminate\Database\Seeder;

class UserPostDownvotedSeeder extends Seeder
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

        factory(App\UserPostDownvoted::class, 100)->make()->each(function($user_post_downvoted) {

            global $results;

            $block = [
                'user_id' => $user_post_downvoted->user_id,
                'post_id' => $user_post_downvoted->post_id,
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
            App\UserPostDownvoted::create($result);
        }
    }
}