<?php

use App\User;
use App\Role;
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
        $role_superadmin = Role::where('name', 'superadmin')->first();
        $role_admin = Role::where('name', 'admin')->first();
        $role_player = Role::where('name', 'player')->first();

        $superadmin = User::firstOrNew(['email' => 'info@nicolasnovello.be']);
        if (!$superadmin->exists) {
            $superadmin->fill([
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
            ])->save();
            $superadmin->roles()->attach($role_superadmin);
        }

        $admin = User::firstOrNew(['email' => 'nico.novello@gmail.com']);
        if (!$admin->exists) {
            $admin->fill([
                'name' => 'Noveni',
                'password' => bcrypt('password'),
            ])->save();
            $admin->roles()->attach($role_admin);
        }

        factory(App\User::class, 5)
            ->create()
            ->each(function($u) use ($role_player){
                $u->roles()->attach($role_player);
            });
    }
}
