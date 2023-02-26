<?php

namespace Database\Seeders;

use Database\Seeders\ArticleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\PermissionSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $seeders = [
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ArticleSeeder::class,
        ];
        $this->call($seeders);
    }
}
