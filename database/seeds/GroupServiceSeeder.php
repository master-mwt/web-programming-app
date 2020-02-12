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
            ['group_id' => 1, 'service_id' => 1],
            ['group_id' => 1, 'service_id' => 2],
            ['group_id' => 1, 'service_id' => 3],
            ['group_id' => 1, 'service_id' => 4],
            ['group_id' => 1, 'service_id' => 5],
            ['group_id' => 1, 'service_id' => 6],
            ['group_id' => 1, 'service_id' => 7],
            ['group_id' => 1, 'service_id' => 8],
            ['group_id' => 1, 'service_id' => 9],
            ['group_id' => 1, 'service_id' => 10],
            ['group_id' => 1, 'service_id' => 11],
            ['group_id' => 1, 'service_id' => 12],
            ['group_id' => 1, 'service_id' => 13],
            ['group_id' => 1, 'service_id' => 14],
            ['group_id' => 1, 'service_id' => 15],
            ['group_id' => 1, 'service_id' => 16],
            // logged: group id 2
            ['group_id' => 2, 'service_id' => 1],
            ['group_id' => 2, 'service_id' => 2],
            ['group_id' => 2, 'service_id' => 3],
            ['group_id' => 2, 'service_id' => 4],
            ['group_id' => 2, 'service_id' => 5],
            ['group_id' => 2, 'service_id' => 6],
            ['group_id' => 2, 'service_id' => 7],
            ['group_id' => 2, 'service_id' => 8],
            ['group_id' => 2, 'service_id' => 11],
            ['group_id' => 2, 'service_id' => 12],
            ['group_id' => 2, 'service_id' => 15],
            ['group_id' => 2, 'service_id' => 16],
        ];

        foreach($groupsServices as $groupService) {
            App\GroupService::create($groupService);
        }
    }
}
