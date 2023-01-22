<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            // admin
            [
                'full_name' => 'Hanif Admin',
                'username' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('1111'),
                'role' => 'admin',
                'status' => 'active'
            ],
            // Vendor
            [
                'full_name' => 'Hanif Vendor',
                'username' => 'Vendor',
                'email' => 'vendor@gmail.com',
                'password' => Hash::make('1111'),
                'role' => 'vendor',
                'status' => 'active'
            ],
            // Customer
            [
                'full_name' => 'Hanif Customer',
                'username' => 'Customer',
                'email' => 'customer@gmail.com',
                'password' => Hash::make('1111'),
                'role' => 'customer',
                'status' => 'active'
            ]
        ]);
    }
}