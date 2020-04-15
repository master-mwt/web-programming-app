<?php

use Illuminate\Database\Seeder;

class UserPostReportedSeeder extends Seeder
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

        factory(App\UserPostReported::class, 300)->make()->each(function($user_post_reported) {

            global $results;

            $block = [
                'user_id' => $user_post_reported->user_id,
                'post_id' => $user_post_reported->post_id,
                'channel_id' => $user_post_reported->channel_id,
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
            App\UserPostReported::create($result);
        }
    }
}
