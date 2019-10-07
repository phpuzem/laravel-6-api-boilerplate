<?php

namespace App\Contracts;

/**
 * Interface CriteriaContract
 * @package App\Contracts
 */
interface CriteriaContract
{
    /**
     * @param mixed ...$criteria
     *
     * @return mixed
     */
    public function withCriteria(...$criteria);
}
