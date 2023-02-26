<?php

namespace App\Policies;

use App\Models\Article;
use Uwla\Lacl\Traits\ResourcePolicy;
use Uwla\Lacl\Contracts\ResourcePolicy as ResourcePolicyContract;

class ArticlePolicy implements ResourcePolicyContract
{
    use ResourcePolicy;

    public function getResourceModel()
    {
        return Article::class;
    }
}
