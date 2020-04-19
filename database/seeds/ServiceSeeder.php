<?php

use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            //POST
            ['name' => 'create_post'],
            ['name' => 'delete_post'],

            //REPLY
            ['name' => 'create_reply'],
            ['name' => 'delete_reply'],

            //COMMENT
            ['name' => 'create_comment'],
            ['name' => 'delete_comment'],

            //CHANNEL
            ['name' => 'create_channel'],
            ['name' => 'delete_channel'],
            ['name' => 'mod_channel_data'],

            //BAN FROM CHANNEL
            ['name' => 'ban_user_from_channel'],    // soft ban
            //BAN FROM PLATFORM
            ['name' => 'ban_user_from_platform'],   // hard ban

            //USER
            ['name' => 'create_user'],
            ['name' => 'delete_user'],
            ['name' => 'mod_user_data'],
            ['name' => 'view_user_data'],

            //BACKEND LOGS
            ['name' => 'access_to_log'],
            //BACKEND
            ['name' => 'access_to_backend'],

            // USER AND CHANNEL
            ['name' => 'silence_user_in_comment_section'],
            ['name' => 'report_user_in_channel'],
            ['name' => 'upgrade_to_moderator'],
            ['name' => 'upgrade_to_admin'],
            ['name' => 'upgrade_to_creator'],
            ['name' => 'downgrade_moderator'],
            ['name' => 'downgrade_admin'],
            ['name' => 'downgrade_creator'],
            ['name' => 'report_post'],
            ['name' => 'view_channel_members_list'],
            ['name' => 'global_post_unreport'],
        ];

        foreach($services as $service) {
            App\Service::create($service);
        }
    }
}
