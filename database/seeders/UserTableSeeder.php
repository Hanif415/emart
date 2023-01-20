<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->DB::insert([
            [
                'full_name' => 'Hanif',
                'username' => 'Admin',
                'email' => 'admin@gmail.com'
            ]
        ])
    }
}