<?php

namespace App\Repositories\Eloquent\Criteria;


use App\Contracts\CriterionContract;

/**
 * Class EagerLoad
 * @package App\Repositories\Eloquent
 */
class EagerLoad implements CriterionContract
{
    /**
     * @var array
     */
    protected $relations;

    /**
     * EagerLoad constructor.
     *
     * @param array $relations
     */
    public function __construct(array $relations)
    {
        $this->relations = $relations;
    }

    /**
     * @param $entity
     *
     * @return mixed
     */
    public function apply($entity)
    {
        return $entity->with($this->relations);
    }
}
