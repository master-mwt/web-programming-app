<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //entities
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ChannelSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(TagSeeder::class);
        
        //relations
        $this->call(UserChannelRoleSeeder::class);
        $this->call(RoleServiceSeeder::class);
        $this->call(GroupServiceSeeder::class);

    }
}
