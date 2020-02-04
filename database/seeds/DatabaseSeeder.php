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

        //relations
        $this->call(UserChannelRoleSeeder::class);
    }
}
