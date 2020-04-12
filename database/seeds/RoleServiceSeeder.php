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
        // ROLES
        $creator = \App\Role::where('name', 'creator')->first()->id;
        $admin = \App\Role::where('name', 'admin')->first()->id;
        $moderator = \App\Role::where('name', 'moderator')->first()->id;
        $member = \App\Role::where('name', 'member')->first()->id;

        // SERVICES
        $create_post = \App\Service::where('name', 'create_post')->first()->id;
        $delete_post = \App\Service::where('name', 'delete_post')->first()->id;
        $create_reply = \App\Service::where('name', 'create_reply')->first()->id;
        $delete_reply = \App\Service::where('name', 'delete_reply')->first()->id;
        $create_comment = \App\Service::where('name', 'create_comment')->first()->id;
        $delete_comment = \App\Service::where('name', 'delete_comment')->first()->id;
        $delete_channel = \App\Service::where('name', 'delete_channel')->first()->id;
        $mod_channel_data = \App\Service::where('name', 'mod_channel_data')->first()->id;
        $ban_user_from_channel = \App\Service::where('name', 'ban_user_from_channel')->first()->id;
        $silence_user_in_comment_section = \App\Service::where('name', 'silence_user_in_comment_section')->first()->id;
        $report_user_in_channel = \App\Service::where('name', 'report_user_in_channel')->first()->id;
        $upgrade_to_moderator = \App\Service::where('name', 'upgrade_to_moderator')->first()->id;
        $upgrade_to_admin = \App\Service::where('name', 'upgrade_to_admin')->first()->id;
        $downgrade_moderator = \App\Service::where('name', 'downgrade_moderator')->first()->id;
        $downgrade_admin = \App\Service::where('name', 'downgrade_admin')->first()->id;
        $report_post = \App\Service::where('name', 'report_post')->first()->id;
        $view_channel_members_list = \App\Service::where('name', 'view_channel_members_list')->first()->id;

        // BINDING ROLE - SERVICE
        $rolesServices = [
            // creator
            ['role_id' => $creator, 'service_id' => $create_post],   //create_post
            ['role_id' => $creator, 'service_id' => $delete_post],   //delete_post

            ['role_id' => $creator, 'service_id' => $create_reply],   //create_post
            ['role_id' => $creator, 'service_id' => $delete_reply],   //delete_post

            ['role_id' => $creator, 'service_id' => $create_comment],   //create_comment
            ['role_id' => $creator, 'service_id' => $delete_comment],   //delete_comment

            ['role_id' => $creator, 'service_id' => $delete_channel],   //delete_channel
            ['role_id' => $creator, 'service_id' => $mod_channel_data],   //mod_channel_data

            ['role_id' => $creator, 'service_id' => $ban_user_from_channel],   //ban_user_from_channel

            ['role_id' => $creator, 'service_id' => $silence_user_in_comment_section],  //silence_user_in_comment_section
            ['role_id' => $creator, 'service_id' => $report_user_in_channel],  //report_user_in_channel

            ['role_id' => $creator, 'service_id' => $upgrade_to_moderator],  //upgrade_to_moderator
            ['role_id' => $creator, 'service_id' => $upgrade_to_admin],  //upgrade_to_admin
            ['role_id' => $creator, 'service_id' => $downgrade_moderator],  //downgrade_moderator
            ['role_id' => $creator, 'service_id' => $downgrade_admin],  //downgrade_admin
            ['role_id' => $creator, 'service_id' => $report_post],  //report_post
            ['role_id' => $creator, 'service_id' => $view_channel_members_list],  //view_channel_members_list

            // admin
            ['role_id' => $admin, 'service_id' => $create_post],   //create_post
            ['role_id' => $admin, 'service_id' => $delete_post],   //delete_post

            ['role_id' => $admin, 'service_id' => $create_reply],   //create_post
            ['role_id' => $admin, 'service_id' => $delete_reply],   //delete_post

            ['role_id' => $admin, 'service_id' => $create_comment],   //create_comment
            ['role_id' => $admin, 'service_id' => $delete_comment],   //delete_comment

            ['role_id' => $admin, 'service_id' => $mod_channel_data],   //mod_channel_data

            ['role_id' => $admin, 'service_id' => $ban_user_from_channel],   //ban_user_from_channel

            ['role_id' => $admin, 'service_id' => $silence_user_in_comment_section],  //silence_user_in_comment_section
            ['role_id' => $admin, 'service_id' => $report_user_in_channel],  //report_user_in_channel

            ['role_id' => $admin, 'service_id' => $upgrade_to_moderator],  //upgrade_to_moderator
            ['role_id' => $admin, 'service_id' => $downgrade_moderator],  //downgrade_moderator
            ['role_id' => $admin, 'service_id' => $report_post],  //report_post
            ['role_id' => $admin, 'service_id' => $view_channel_members_list],  //view_channel_members_list

            // moderator
            ['role_id' => $moderator, 'service_id' => $create_post],   //create_post
            ['role_id' => $moderator, 'service_id' => $delete_post],   //delete_post

            ['role_id' => $moderator, 'service_id' => $create_reply],   //create_post
            ['role_id' => $moderator, 'service_id' => $delete_reply],   //delete_post

            ['role_id' => $moderator, 'service_id' => $create_comment],   //create_comment
            ['role_id' => $moderator, 'service_id' => $delete_comment],   //delete_comment

            ['role_id' => $moderator, 'service_id' => $ban_user_from_channel],   //ban_user_from_channel

            ['role_id' => $moderator, 'service_id' => $silence_user_in_comment_section],  //silence_user_in_comment_section
            ['role_id' => $moderator, 'service_id' => $report_user_in_channel],  //report_user_in_channel

            ['role_id' => $moderator, 'service_id' => $report_post],  //report_post
            ['role_id' => $moderator, 'service_id' => $view_channel_members_list],  //view_channel_members_list

            // member
            ['role_id' => $member, 'service_id' => $create_post],   //create_post
            ['role_id' => $member, 'service_id' => $delete_post],   //delete_post

            ['role_id' => $member, 'service_id' => $create_reply],   //create_post
            ['role_id' => $member, 'service_id' => $delete_reply],   //delete_post

            ['role_id' => $member, 'service_id' => $create_comment],   //create_comment
            ['role_id' => $member, 'service_id' => $delete_comment],   //delete_comment

            ['role_id' => $member, 'service_id' => $report_post],  //report_post
            ['role_id' => $member, 'service_id' => $view_channel_members_list],  //view_channel_members_list

        ];

        foreach($rolesServices as $roleService) {
            App\RoleService::create($roleService);
        }
    }
}
