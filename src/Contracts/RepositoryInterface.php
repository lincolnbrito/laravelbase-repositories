<?php
namespace LincolnBrito\LaravelBaseRepositories\Contracts;

/**
 * Interface RepositoryInterface
 * @package LincolnBrito\LaravelBaseRepositories\Contracts
 */
interface RepositoryInterface
{

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'));

    /**
     * @param int $perPage
     * @param array $columns
     * @param mixed $persit
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*'), $persit = array());

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id");

    /**
     * @param array $ids
     * @return mixed
     */
    public function delete(array $ids);

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'));

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*'));
}