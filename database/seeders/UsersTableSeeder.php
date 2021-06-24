<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\LevelDif;
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
    


    $leveldifs = [
            [
                'id'             => 1,
                'remote_id'     => 0
            ],  

            [
                'id'             => 2,
                'remote_id'     => 1
            ],      

            [
                'id'             => 3,
                'remote_id'     => 2
            ],
        ];

        LevelDif::insert($leveldifs);
    }
}
