<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'creator'],
            ['name' => 'admin'],
            ['name' => 'moderator'],
            ['name' => 'member'],
        ];

        foreach($roles as $role) {
            App\Role::create($role);
        }
    }
}
