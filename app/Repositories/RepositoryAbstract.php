<?php

namespace App\Repositories;


use App\Contracts\RepositoryContract;

/**
 * Class RepositoryAbstract
 * @package App\Repositories
 */
abstract class RepositoryAbstract implements RepositoryContract
{
    /**
     * @var
     */
    protected $entity;


    ##### Shared For All Repositories #####

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->entity->all();
    }

    /**
     * @param $perPage
     *
     * @return mixed
     */
    public function paginate($perPage)
    {
        return $this->entity->paginate($perPage);
    }

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function store(array $attributes)
    {
        return $this->entity->create($attributes);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function show($id)
    {
        return $this->entity->findOrFail($id);
    }

    /**
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        return $this->show($attributes)->update($attributes);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->entity->delete($id);
    }
}
