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
            ['role_id' => 1, 'service_id' => 1],
            ['role_id' => 1, 'service_id' => 2],
            ['role_id' => 1, 'service_id' => 3],
            ['role_id' => 1, 'service_id' => 4],
            ['role_id' => 1, 'service_id' => 6],
            ['role_id' => 1, 'service_id' => 7],
            ['role_id' => 1, 'service_id' => 8],
            ['role_id' => 1, 'service_id' => 15],
            ['role_id' => 1, 'service_id' => 16],
            // admin: role id 2
            ['role_id' => 2, 'service_id' => 1],
            ['role_id' => 2, 'service_id' => 2],
            ['role_id' => 2, 'service_id' => 3],
            ['role_id' => 2, 'service_id' => 4],
            ['role_id' => 2, 'service_id' => 8],
            ['role_id' => 2, 'service_id' => 15],
            ['role_id' => 2, 'service_id' => 16],
            // moderator: role id 3
            ['role_id' => 3, 'service_id' => 1],
            ['role_id' => 3, 'service_id' => 2],
            ['role_id' => 3, 'service_id' => 3],
            ['role_id' => 3, 'service_id' => 4],
            ['role_id' => 3, 'service_id' => 15],
            ['role_id' => 3, 'service_id' => 16],
            // member: role id 4
            ['role_id' => 4, 'service_id' => 1],
            ['role_id' => 4, 'service_id' => 2],
            ['role_id' => 4, 'service_id' => 3],
            ['role_id' => 4, 'service_id' => 4],
        ];

        foreach($rolesServices as $roleService) {
            App\RoleService::create($roleService);
        }
    }
}
