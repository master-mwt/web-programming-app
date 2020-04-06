<?php

use Illuminate\Database\Seeder;

class GroupServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groupsServices = [
            // administrator: group id 1
            ['group_id' => 1, 'service_id' => 1],   //create_post
            ['group_id' => 1, 'service_id' => 2],   //delete_post

            ['group_id' => 1, 'service_id' => 3],   //create_post
            ['group_id' => 1, 'service_id' => 4],   //delete_post

            ['group_id' => 1, 'service_id' => 5],   //create_comment
            ['group_id' => 1, 'service_id' => 6],   //delete_comment

            ['group_id' => 1, 'service_id' => 7],   //create_channel
            ['group_id' => 1, 'service_id' => 8],   //delete_channel
            ['group_id' => 1, 'service_id' => 9],   //mod_channel_data

            ['group_id' => 1, 'service_id' => 10],   //ban_user_from_channel
            ['group_id' => 1, 'service_id' => 11],   //ban_user_from_platform

            ['group_id' => 1, 'service_id' => 12],  //create_user
            ['group_id' => 1, 'service_id' => 13],  //delete_user
            ['group_id' => 1, 'service_id' => 14],  //mod_user_data

            ['group_id' => 1, 'service_id' => 15],  //access_to_log
            ['group_id' => 1, 'service_id' => 16],  //access_to_backend

            ['group_id' => 1, 'service_id' => 17],  //silence_user_in_comment_section
            ['group_id' => 1, 'service_id' => 18],  //report_user_in_channel
            
            // logged user: group id 2
            ['group_id' => 2, 'service_id' => 7],   //create_channel

            ['group_id' => 2, 'service_id' => 13],  //delete_user
            ['group_id' => 2, 'service_id' => 14],  //mod_user_data
        ];

        foreach($groupsServices as $groupService) {
            App\GroupService::create($groupService);
        }
    }
}
