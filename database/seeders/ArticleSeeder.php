<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create per-article permissions for demonstration purposes
        $a1 = Article::factory()->createOne();
        $a2 = Article::factory()->createOne();
        $a1->createCrudPermissions();
        $a2->createCrudPermissions();

        // password
        $pass = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

        // these are the users which will have per-article permissions
        $u1 = User::create(['name' => 'u1', 'email' => 'u1@example.test', 'password' => $pass]);
        $u2 = User::create(['name' => 'u2', 'email' => 'u2@example.test', 'password' => $pass]);
        $u3 = User::create(['name' => 'u3', 'email' => 'u3@example.test', 'password' => $pass]);
        $u4 = User::create(['name' => 'u4', 'email' => 'u4@example.test', 'password' => $pass]);

        // attach the permissions
        $a1->attachCrudPermissions($u1);
        $a2->attachCrudPermissions($u2);
        $a1->attachDeletePermission($u3);
        $a2->attachDeletePermission($u4);

        // generate many articles
        Article::factory(100)->create();
    }
}
