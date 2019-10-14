<?php

namespace App\Repositories\Eloquent;

use App\Contracts\{JobContract};
use App\Http\Models\Job;
use App\Repositories\RepositoryAbstract;

/**
 * Class JobRepository
 * @package App\Repositories
 */
class JobRepository extends RepositoryAbstract implements JobContract
{
    /**
     * @return string
     */
    public function entity()
    {
        return Job::class;
    }

}
