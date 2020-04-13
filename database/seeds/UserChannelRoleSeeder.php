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

        $channels = \App\Channel::all();
        $creator_role = \App\Role::where('name', 'creator')->first();

        foreach ($channels as $channel){
            array_push($results, ['user_id' => $channel->creator_id, 'channel_id' => $channel->id, 'role_id' => $creator_role->id]);
        }

        factory(App\UserChannelRole::class, 500)->make()->each(function($user_channel_role) {

            global $results;

            $block = [
                'user_id' => $user_channel_role->user_id,
                'channel_id' => $user_channel_role->channel_id,
                'role_id' => $user_channel_role->role_id
            ];

            $guard = false;
            foreach($results as $elem) {
                if($elem !== $block && $guard == false) {
                    if($elem['user_id'] === $block['user_id'] && $elem['channel_id'] === $block['channel_id']){
                        $guard = true;
                        break;
                    } else {
                        continue;
                    }
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
