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
            ['group_id' => 1, 'service_id' => 3],   //create_comment
            ['group_id' => 1, 'service_id' => 4],   //delete_comment
            ['group_id' => 1, 'service_id' => 5],   //create_channel
            ['group_id' => 1, 'service_id' => 6],   //delete_channel
            ['group_id' => 1, 'service_id' => 7],   //mod_channel_data
            ['group_id' => 1, 'service_id' => 8],   //ban_user_from_channel
            ['group_id' => 1, 'service_id' => 9],   //ban_user_from_platform
            ['group_id' => 1, 'service_id' => 10],  //create_user
            ['group_id' => 1, 'service_id' => 11],  //delete_user
            ['group_id' => 1, 'service_id' => 12],  //mod_user_data
            ['group_id' => 1, 'service_id' => 13],  //access_to_log
            ['group_id' => 1, 'service_id' => 14],  //access_to_backend
            ['group_id' => 1, 'service_id' => 15],  //silence_user_in_comment_section
            ['group_id' => 1, 'service_id' => 16],  //report_user_in_channel
            // logged: group id 2
            ['group_id' => 2, 'service_id' => 5],   //create_channel
            ['group_id' => 2, 'service_id' => 11],  //delete_user
            ['group_id' => 2, 'service_id' => 12],  //mod_user_data
        ];

        foreach($groupsServices as $groupService) {
            App\GroupService::create($groupService);
        }
    }
}
