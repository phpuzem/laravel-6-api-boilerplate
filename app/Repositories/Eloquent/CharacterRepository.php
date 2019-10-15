<?php

namespace App\Repositories\Eloquent;

use App\Contracts\{CharacterContract};
use App\Http\Models\Job;
use App\Repositories\RepositoryAbstract;

/**
 * Class JobRepository
 * @package App\Repositories
 */
class CharacterRepository extends RepositoryAbstract implements CharacterContract
{
    /**
     * @return string
     */
    public function entity()
    {
        return Job::class;
    }

}
