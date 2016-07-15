<?php
namespace LincolnBrito\LaravelBaseRepositories\Search;

use Illuminate\Container\Container as App;
use LincolnBrito\LaravelBaseRepositories\Contracts\CriteriaInterface as Repository;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface;
use LincolnBrito\LaravelBaseRepositories\Exceptions\CriteriaException;


abstract class Search
{
    /** @var array */
    protected $params;
    /** @var  array */
    protected $fill = [];
    /** @var  App */
    private $app;

    protected $model;

    protected $repository;

    /**
     * Criteria constructor.
     * @param App $app
     * @param array $values
     */
    public function __construct(App $app, $values = [])
    {
        $this->app = $app;

        if (is_array($values)) {
            foreach ($values as $key => $val) {
                if (in_array($key, $this->fill))
                    $this->params[$key] = $val;
            }
        }
    }

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