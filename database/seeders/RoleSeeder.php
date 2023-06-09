<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Uwla\Lacl\Models\Permission;
use Uwla\Lacl\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'admin',
            'description' => 'administrates everything'
        ]);
        $userManager = Role::create([
            'name' => 'user manager',
            'description' => 'manages users'
        ]);
        $manager = Role::create([
            'name' => 'chief manager',
            'description' => 'manages access control'
        ]);
        $editor = Role::create([
            'name' => 'editor',
            'description' => 'manages articles'
        ]);

        $adminPermissions = Permission::all();
        $userManagerPermissions = Permission::where('model', User::class)->get();
        $managerPermissions = Permission::whereIn('model', [User::class, Role::class])->get();
        $editorPermissions = Permission::where('model', Article::class)->get();

        $admin->addPermissions($adminPermissions);
        $userManager->addPermissions($userManagerPermissions);
        $manager->addPermissions($managerPermissions);
        $editor->addPermissions($editorPermissions);
    }
}
