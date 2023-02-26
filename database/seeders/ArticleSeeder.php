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
        Article::factory(100)->create();

        // create per-model permissions for demonstration purposes
        $a1 = Article::find(1);
        $a2 = Article::find(2);
        $u1 = User::find(1);
        $u2 = User::find(2);
        $u3 = User::find(3);
        $u4 = User::find(4);

        $a1->createCrudPermissions();
        $a2->createCrudPermissions();
        $a1->attachCrudPermissions($u1);
        $a2->attachCrudPermissions($u2);
        $a1->attachDeletePermission($u3);
        $a2->attachDeletePermission($u4);
    }
}
