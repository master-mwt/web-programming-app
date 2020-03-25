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
        $this->call(ImageSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ChannelSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(ReplySeeder::class);
        $this->call(CommentSeeder::class);

        //relations
        $this->call(UserChannelRoleSeeder::class);
        $this->call(RoleServiceSeeder::class);
        $this->call(GroupServiceSeeder::class);
        $this->call(PostTagSeeder::class);
        $this->call(UserPostDownvotedSeeder::class);
        $this->call(UserPostHiddenSeeder::class);
        $this->call(UserPostReportedSeeder::class);
        $this->call(UserPostSavedSeeder::class);
        $this->call(UserPostUpvotedSeeder::class);
    }
}
