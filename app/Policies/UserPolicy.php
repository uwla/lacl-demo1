<?php

namespace App\Policies;

use App\Models\User;
use Uwla\Lacl\Traits\ResourcePolicy;
use Uwla\Lacl\Contracts\ResourcePolicy as ResourcePolicyContract;

class UserPolicy implements ResourcePolicyContract
{
    use ResourcePolicy;

    public function getResourceModel()
    {
        return User::class;
    }
}
