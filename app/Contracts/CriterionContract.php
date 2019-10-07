<?php

namespace App\Contracts;

/**
 * Interface CriterionContract
 * @package App\Contracts
 */
interface CriterionContract
{
    /**
     * @param $entity
     *
     * @return mixed
     */
    public function apply($entity);
}
