<?php

namespace App\Repositories\Eloquent;


use App\Contracts\UserContract;
use App\Http\Models\User;
use App\Repositories\RepositoryAbstract;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository extends RepositoryAbstract implements UserContract
{
    /**
     * @return string
     */
    public function entity()
    {
        return User::class;
    }
}
