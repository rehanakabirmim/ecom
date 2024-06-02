<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //  Admin
            [
                'name'=>'Admin',
                'username'=>'admin';
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('111'),
                'role'=>'admin',
                'status'=>'active',
            ],

            // Vendor
            [
                'name'=>'Vendor',
                'username'=>'vendor';
                'email'=>'vendor@gmail.com',
                'password'=>Hash::make('111'),
                'role'=>'vendor',
                'status'=>'active',
            ],

            // User or Customer
            [
                'name'=>'User',
                'username'=>'user';
                'email'=>'user@gmail.com',
                'password'=>Hash::make('111'),
                'role'=>'user',
                'status'=>'active',
            ],


        ]);
    }
}
