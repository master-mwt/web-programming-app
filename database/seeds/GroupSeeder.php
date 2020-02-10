<?php

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            ['name' => 'administrator'],
            ['name' => 'logged'],
        ];

        foreach($groups as $group) {
            App\Group::create($group);
        }
    }
}
