<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'game_create',
            ],
            [
                'id'    => 18,
                'title' => 'game_edit',
            ],
            [
                'id'    => 19,
                'title' => 'game_show',
            ],
            [
                'id'    => 20,
                'title' => 'game_delete',
            ],
            [
                'id'    => 21,
                'title' => 'game_access',
            ],
            [
                'id'    => 22,
                'title' => 'message_create',
            ],
            [
                'id'    => 23,
                'title' => 'message_edit',
            ],
            [
                'id'    => 24,
                'title' => 'message_show',
            ],
            [
                'id'    => 25,
                'title' => 'message_delete',
            ],
            [
                'id'    => 26,
                'title' => 'message_access',
            ],
            [
                'id'    => 27,
                'title' => 'level_create',
            ],
            [
                'id'    => 28,
                'title' => 'level_edit',
            ],
            [
                'id'    => 29,
                'title' => 'level_show',
            ],
            [
                'id'    => 30,
                'title' => 'level_delete',
            ],
            [
                'id'    => 31,
                'title' => 'level_access',
            ],
            [
                'id'    => 32,
                'title' => 'world_create',
            ],
            [
                'id'    => 33,
                'title' => 'world_edit',
            ],
            [
                'id'    => 34,
                'title' => 'world_show',
            ],
            [
                'id'    => 35,
                'title' => 'world_delete',
            ],
            [
                'id'    => 36,
                'title' => 'world_access',
            ],
            [
                'id'    => 37,
                'title' => 'analytic_create',
            ],
            [
                'id'    => 38,
                'title' => 'analytic_edit',
            ],
            [
                'id'    => 39,
                'title' => 'analytic_show',
            ],
            [
                'id'    => 40,
                'title' => 'analytic_delete',
            ],
            [
                'id'    => 41,
                'title' => 'analytic_access',
            ],
            [
                'id'    => 42,
                'title' => 'custom_key_create',
            ],
            [
                'id'    => 43,
                'title' => 'custom_key_edit',
            ],
            [
                'id'    => 44,
                'title' => 'custom_key_show',
            ],
            [
                'id'    => 45,
                'title' => 'custom_key_delete',
            ],
            [
                'id'    => 46,
                'title' => 'custom_key_access',
            ],
            [
                'id'    => 47,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
