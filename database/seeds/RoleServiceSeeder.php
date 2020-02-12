<?php

use Illuminate\Database\Seeder;

class RoleServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesServices = [
            // creator: role id 1
            ['role_id' => 1, 'service_id' => 1],    //create_post
            ['role_id' => 1, 'service_id' => 2],    //delete_post
            ['role_id' => 1, 'service_id' => 3],    //create_comment
            ['role_id' => 1, 'service_id' => 4],    //delete_comment
            ['role_id' => 1, 'service_id' => 6],    //delete_channel
            ['role_id' => 1, 'service_id' => 7],    //mod_channel_data
            ['role_id' => 1, 'service_id' => 8],    //ban_user_from_channel
            ['role_id' => 1, 'service_id' => 15],   //silence_user_in_comment_section
            ['role_id' => 1, 'service_id' => 16],   //report_user_in_channel
            // admin: role id 2
            ['role_id' => 2, 'service_id' => 1],    //create_post
            ['role_id' => 2, 'service_id' => 2],    //delete_post
            ['role_id' => 2, 'service_id' => 3],    //create_comment
            ['role_id' => 2, 'service_id' => 4],    //delete_comment
            ['role_id' => 2, 'service_id' => 8],    //ban_user_from_channel
            ['role_id' => 2, 'service_id' => 15],   //silence_user_in_comment_section
            ['role_id' => 2, 'service_id' => 16],   //report_user_in_channel
            // moderator: role id 3
            ['role_id' => 3, 'service_id' => 1],    //create_post
            ['role_id' => 3, 'service_id' => 2],    //delete_post
            ['role_id' => 3, 'service_id' => 3],    //create_comment
            ['role_id' => 3, 'service_id' => 4],    //delete_comment
            ['role_id' => 3, 'service_id' => 15],   //silence_user_in_comment_section
            ['role_id' => 3, 'service_id' => 16],   //report_user_in_channel
            // member: role id 4
            ['role_id' => 4, 'service_id' => 1],    //create_post
            ['role_id' => 4, 'service_id' => 2],    //delete_post
            ['role_id' => 4, 'service_id' => 3],    //create_comment
            ['role_id' => 4, 'service_id' => 4],    //delete_comment
        ];

        foreach($rolesServices as $roleService) {
            App\RoleService::create($roleService);
        }
    }
}
