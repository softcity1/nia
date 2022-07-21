<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name' => 'nia',
                'last_name' => 'admin',
                'name' => 'nia admin',
                'email' => 'fahadislam369@gmail.com',
                'email_verified_at' => now(),
                'user_type' => 0,
                'is_reset_password' => 1,
                'password' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('users')->truncate();
        DB::table('users')->insert($users);
    }
}
