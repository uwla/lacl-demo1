<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Uwla\Lacl\Models\Permission;
use Uwla\Lacl\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resources = [
            "user" => User::class,
            "role" => Role::class,
            "permission" => Permission::class,
            "article" => Article::class,
        ];
        $actions = ["create", "delete", "forceDelete", "update", "view"];
        $actionSuffix = "Any";
        $permissions = [];

        foreach ($resources as $name => $resource)
        {
            foreach ($actions as $action)
            {
                $actionName = $name . "." . $action . $actionSuffix;
                $permissions[] = [
                    'name' => $actionName,
                    'model' => $resource,
                ];
            }
        }

        Permission::insert($permissions);
    }
}
