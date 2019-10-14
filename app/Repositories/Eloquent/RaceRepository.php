<?php

namespace App\Repositories\Eloquent;

use App\Contracts\{RaceContract};
use App\Http\Models\Race;
use App\Repositories\RepositoryAbstract;

/**
 * Class RaceRepository
 * @package App\Repositories
 */
class RaceRepository extends RepositoryAbstract implements RaceContract
{
    /**
     * @return string
     */
    public function entity()
    {
        return Race::class;
    }

}
