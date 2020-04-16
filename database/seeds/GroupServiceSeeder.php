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
        // GROUPS
        $administrator = \App\Group::where('name', 'administrator')->first()->id;
        $logged = \App\Group::where('name', 'logged')->first()->id;

        // SERVICES
        $create_post = \App\Service::where('name', 'create_post')->first()->id;
        $delete_post = \App\Service::where('name', 'delete_post')->first()->id;
        $create_reply = \App\Service::where('name', 'create_reply')->first()->id;
        $delete_reply = \App\Service::where('name', 'delete_reply')->first()->id;
        $create_comment = \App\Service::where('name', 'create_comment')->first()->id;
        $delete_comment = \App\Service::where('name', 'delete_comment')->first()->id;
        $create_channel = \App\Service::where('name', 'create_channel')->first()->id;
        $delete_channel = \App\Service::where('name', 'delete_channel')->first()->id;
        $mod_channel_data = \App\Service::where('name', 'mod_channel_data')->first()->id;
        $ban_user_from_channel = \App\Service::where('name', 'ban_user_from_channel')->first()->id;
        $ban_user_from_platform = \App\Service::where('name', 'ban_user_from_platform')->first()->id;
        $create_user = \App\Service::where('name', 'create_user')->first()->id;
        $delete_user = \App\Service::where('name', 'delete_user')->first()->id;
        $mod_user_data = \App\Service::where('name', 'mod_user_data')->first()->id;
        $view_user_data = \App\Service::where('name', 'view_user_data')->first()->id;
        $access_to_log = \App\Service::where('name', 'access_to_log')->first()->id;
        $access_to_backend = \App\Service::where('name', 'access_to_backend')->first()->id;
        $silence_user_in_comment_section = \App\Service::where('name', 'silence_user_in_comment_section')->first()->id;
        $report_user_in_channel = \App\Service::where('name', 'report_user_in_channel')->first()->id;
        $upgrade_to_moderator = \App\Service::where('name', 'upgrade_to_moderator')->first()->id;
        $upgrade_to_admin = \App\Service::where('name', 'upgrade_to_admin')->first()->id;
        $upgrade_to_creator = \App\Service::where('name', 'upgrade_to_creator')->first()->id;
        $downgrade_moderator = \App\Service::where('name', 'downgrade_moderator')->first()->id;
        $downgrade_admin = \App\Service::where('name', 'downgrade_admin')->first()->id;
        $downgrade_creator = \App\Service::where('name', 'downgrade_creator')->first()->id;
        $report_post = \App\Service::where('name', 'report_post')->first()->id;
        $view_channel_members_list = \App\Service::where('name', 'view_channel_members_list')->first()->id;

        // BINDING GROUP - SERVICE
        $groupsServices = [
            // administrator
            ['group_id' => $administrator, 'service_id' => $create_post],   //create_post
            ['group_id' => $administrator, 'service_id' => $delete_post],   //delete_post

            ['group_id' => $administrator, 'service_id' => $create_reply],   //create_post
            ['group_id' => $administrator, 'service_id' => $delete_reply],   //delete_post

            ['group_id' => $administrator, 'service_id' => $create_comment],   //create_comment
            ['group_id' => $administrator, 'service_id' => $delete_comment],   //delete_comment

            ['group_id' => $administrator, 'service_id' => $create_channel],   //create_channel
            ['group_id' => $administrator, 'service_id' => $delete_channel],   //delete_channel
            ['group_id' => $administrator, 'service_id' => $mod_channel_data],   //mod_channel_data

            ['group_id' => $administrator, 'service_id' => $ban_user_from_channel],   //ban_user_from_channel
            ['group_id' => $administrator, 'service_id' => $ban_user_from_platform],   //ban_user_from_platform

            ['group_id' => $administrator, 'service_id' => $create_user],  //create_user
            ['group_id' => $administrator, 'service_id' => $delete_user],  //delete_user
            ['group_id' => $administrator, 'service_id' => $mod_user_data],  //mod_user_data
            ['group_id' => $administrator, 'service_id' => $view_user_data],  //view_user_data

            ['group_id' => $administrator, 'service_id' => $access_to_log],  //access_to_log
            ['group_id' => $administrator, 'service_id' => $access_to_backend],  //access_to_backend

            ['group_id' => $administrator, 'service_id' => $silence_user_in_comment_section],  //silence_user_in_comment_section
            ['group_id' => $administrator, 'service_id' => $report_user_in_channel],  //report_user_in_channel

            ['group_id' => $administrator, 'service_id' => $upgrade_to_moderator],  //upgrade_to_moderator
            ['group_id' => $administrator, 'service_id' => $upgrade_to_admin],  //upgrade_to_admin
            ['group_id' => $administrator, 'service_id' => $upgrade_to_creator],  //upgrade_to_creator
            ['group_id' => $administrator, 'service_id' => $downgrade_moderator],  //downgrade_moderator
            ['group_id' => $administrator, 'service_id' => $downgrade_admin],  //downgrade_admin
            ['group_id' => $administrator, 'service_id' => $downgrade_creator],  //downgrade_creator
            ['group_id' => $administrator, 'service_id' => $report_post],  //report_post
            ['group_id' => $administrator, 'service_id' => $view_channel_members_list],  //view_channel_members_list

            // logged
            ['group_id' => $logged, 'service_id' => $create_channel],   //create_channel

            ['group_id' => $logged, 'service_id' => $mod_user_data],  //mod_user_data
            ['group_id' => $logged, 'service_id' => $view_user_data],  //view_user_data

        ];

        foreach($groupsServices as $groupService) {
            App\GroupService::create($groupService);
        }
    }
}
