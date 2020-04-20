<?php

use Illuminate\Database\Seeder;

class UserHardBannedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\UserHardBanned::class, 2)->create();
    }
}
