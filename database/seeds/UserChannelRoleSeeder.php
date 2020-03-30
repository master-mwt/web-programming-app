<?php

use Illuminate\Database\Seeder;

class UserChannelRoleSeeder extends Seeder
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

        factory(App\UserChannelRole::class, 100)->make()->each(function($user_channel_role) {

            global $results;

            $block = [
                'user_id' => $user_channel_role->user_id,
                'channel_id' => $user_channel_role->channel_id,
                'role_id' => $user_channel_role->role_id
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
            App\UserChannelRole::create($result);
        }
    }
}
