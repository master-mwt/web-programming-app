<?php

use Illuminate\Database\Seeder;

class UserReportedSeeder extends Seeder
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

        factory(App\UserReported::class, 15)->make()->each(function($user_reported) {

            global $results;

            $block = [
                'user_id' => $user_reported->user_id,
                'channel_id' => $user_reported->channel_id,
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
            App\UserReported::create($result);
        }
    }
}
