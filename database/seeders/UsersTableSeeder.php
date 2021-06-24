<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],  

            [
                'id'             => 2,
                'name'           => 'Christiana',
                'email'          => 'chr.fragkouli@gmail.com',
                'password'       => bcrypt('bender0112*'),
                'remember_token' => null,
            ],      

            [
                'id'             => 3,
                'name'           => 'Oliver',
                'email'          => 'omontor@gmail.com',
                'password'       => bcrypt('secret'),
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
