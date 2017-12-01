<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_super_admin = Role::firstOrNew([
            'name' => 'superadmin',
        ]);
        if (!$role_super_admin->exists) {
            $role_super_admin->fill([
                'display_name' => 'Super Administrator',
                'description' => 'GOD',
            ])->save();
        }

        $role_admin = Role::firstOrNew([
            'name' => 'admin',
        ]);
        if (!$role_admin->exists) {
            $role_admin->fill([
                'display_name' => 'Administrator',
                'description' => 'He got all the rights, except managing and creating users',
            ])->save();
        }

        $role_player = Role::firstOrNew([
            'name' => 'player',
        ]);
        if (!$role_player->exists) {
            $role_player->fill([
                'display_name' => 'Player',
                'description' => 'Yeah that\' it',
            ])->save();
        }

    }
}
