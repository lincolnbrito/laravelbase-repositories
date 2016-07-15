<?php
namespace LincolnBrito\LaravelBaseRepositories\Search;

use Illuminate\Database\Eloquent\Model;
use LincolnBrito\LaravelBaseRepositories\Contracts\CriteriaInterface as Repository;

abstract class Search
{
    /**
     * @var array
     */
    protected $params;

    /**
     * @var array
     */
    protected $fill = [];

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Repository
     */
    protected $repository;


    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (in_array($name, $this->fill))
            return isset($this->params[$name]) ? $this->params[$name] : null;

    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if (in_array($name, $this->fill))
            $this->params[$name] = $value;
    }

    /**
     * Override params
     * @param $values
     */
    public function setParams($values)
    {
        if (is_array($values)) {
            foreach ($values as $key => $val) {
                if (in_array($key, $this->fill))
                    $this->params[$key] = $val;
            }
        }

    }

    /**
     * @param $model
     * @param Repository $repository
     */
    public function buildDefaultCriterias($model, Repository $repository){
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    abstract public function buidCriterias($model, Repository $repository);

//    /**
//     * @param Repository $repository
//     * @return $this|void
//     * @throws CriteriaException
//     */
//    public function apply(Repository $repository)
//    {
//        $namespace = substr(get_class($repository), 0, strrpos(get_class($repository), '\\')) . "\\Criterias\\";
//
//        if (empty($this->params))
//            return;
//
//        foreach ($this->params as $criteriaName => $value) {
//            $className = $namespace . str_replace(' ', '', ucwords(str_replace('_', ' ', $criteriaName)));
//            if (!class_exists($className))
//                throw new CriteriaException("The criteria class $className doesn't exists");
//            $repository->pushCriteria($this->app->make($className, [$this->params]));
//        }
//    }
}