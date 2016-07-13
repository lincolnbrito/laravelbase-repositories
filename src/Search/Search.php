<?php
namespace LincolnBrito\LaravelBaseRepositories\Search;

use Illuminate\Container\Container as App;
use LincolnBrito\LaravelBaseRepositories\Contracts\CriteriaInterface as Repository;
use LincolnBrito\LaravelBaseRepositories\Exceptions\CriteriaException;


class Search
{
    /** @var  App */
    private $app;

    /** @var array */
    protected $params;

    /** @var  array */
    protected $fill = [];

    /**
     * Criteria constructor.
     * @param App $app
     * @param array $values
     */
    public function __construct(App $app, $values = []){
        $this->app = $app;

        if(is_array($values)){
            foreach ($values as $key => $val){
                if(in_array($key, $this->fill))
                    $this->params[$key] = $val;
            }
        }
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if(in_array($name, $this->fill))
            $this->params[$name] = $value;
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
     * Override params
     * @param $values
     */
    public function setParams($values){
        if(is_array($values)){
            foreach ($values as $key => $val){
                if(in_array($key, $this->fill))
                    $this->params[$key] = $val;
            }
        }
    }

    /**
     * @param Repository $repository
     * @throws CriteriaException
     */
    public function apply(Repository $repository){
        $namespace = substr(get_class($repository), 0, strrpos(get_class($repository), '\\')) . "\\Criterias\\";

        if(empty($this->params))
            return;

        foreach ($this->params as $criteriaName => $value) {
            $className = $namespace . str_replace(' ', '', ucwords(str_replace('_', ' ', $criteriaName)));
            if (!class_exists($className))
                throw new CriteriaException("The criteria class $className doesn't exists");
            $repository->pushCriteria($this->app->make($className, [$this->params]));
        }
    }
}