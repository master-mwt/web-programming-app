<?php

use Illuminate\Database\Seeder;

class UserSoftBannedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\UserSoftBanned::class, 5)->create();
    }
}
