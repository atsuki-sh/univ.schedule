<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'atsuki',
            'email' => 'blue@example.com',
            'password' => bcrypt('bluegreen'),
        ]);

        DB::table('users')->insert([
            'name' => 'shinoto',
            'email' => 'green@example.com',
            'password' => bcrypt('greenblue'),
        ]);
    }
}
