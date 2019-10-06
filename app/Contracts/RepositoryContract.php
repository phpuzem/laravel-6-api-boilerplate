<?php

namespace App\Contracts;


/**
 * Interface RepositoryContract
 * @package App\Contracts
 */
interface RepositoryContract
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param $perPage
     *
     * @return mixed
     */
    public function paginate($perPage);

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function store(array $attributes);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function show($id);

    /**
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     */
    public function update(array $attributes, $id);

    /**
     * @param $id
     *
     * @return mixed
     */
    public function destroy($id);

}
