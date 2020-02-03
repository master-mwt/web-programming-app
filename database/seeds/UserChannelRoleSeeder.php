<?php

use Illuminate\Database\Seeder;

class UserChannelRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\UserChannelRole::class, 50)->create();
    }
}
