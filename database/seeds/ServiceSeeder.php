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
            ['name' => 'create_post'],
            ['name' => 'delete_post'],

            ['name' => 'create_comment'],
            ['name' => 'delete_comment'],

            ['name' => 'create_channel'],
            ['name' => 'delete_channel'],
            ['name' => 'modify_channel_data'],

            ['name' => 'ban_user_from_channel'],    // soft ban
            ['name' => 'ban_user_from_platform'],   // hard ban

            ['name' => 'create_user'],
            ['name' => 'delete_user'],
            ['name' => 'modify_user_data'],

            ['name' => 'access_to_log'],
            ['name' => 'access_to_backend'],
        ];

        foreach($services as $service) {
            App\Service::create($service);
        }
    }
}
