<?php

namespace Database\Seeders;

use App\Models\User;
use Uwla\Lacl\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // generate some random users
        User::factory(30)->create();
        $users = User::all();
        $roles = Role::all();
        foreach ($users as $user)
        {
            $role = $roles->random(1)[0];
            $user->addRole($role);
        }

        // pick the main roles
        $role_admin         = Role::where(['name' => 'admin'])->first();
        $role_editor        = Role::where(['name' => 'editor'])->first();
        $role_user_manager  = Role::where(['name' => 'user manager'])->first();
        $role_chief_manager = Role::where(['name' => 'chief manager'])->first();

        // password
        $pass = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

        // create one user for each main role
        // the thing is, the email are easy to remember for these users
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.test',
            'password' => $pass
        ])->addRole($role_admin);
        User::create([
            'name' => 'editor',
            'email' => 'editor@example.test',
            'password' => $pass
        ])->addRole($role_editor);
        User::create([
            'name' => 'User manager',
            'email' => 'user_manager@example.test',
            'password' => $pass
        ])->addRole($role_user_manager);
        User::create([
            'name' => 'manager',
            'email' => 'manager@example.test',
            'password' => $pass
        ])->addRole($role_chief_manager);
    }
}
