<?php

namespace App\Repositories\Eloquent;

use App\Contracts\{PermissionContract};
use App\Repositories\RepositoryAbstract;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionRepository
 * @package App\Repositories
 */
class PermissionRepository extends RepositoryAbstract implements PermissionContract
{
    /**
     * @return string
     */
    public function entity()
    {
        return Permission::class;
    }

}
