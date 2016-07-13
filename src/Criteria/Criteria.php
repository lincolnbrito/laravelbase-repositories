<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria;

use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

abstract class Criteria
{
    protected $values = [];
    protected $fill;

    /**
     * Criteria constructor.
     * @param $values
     */
    public function __construct($values){
        if(is_array($values)){
            foreach ($values as $key => $val){
                if(in_array($key, $this->fill))
                    $this->values[$key] = $val;
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
            $this->values[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (in_array($name, $this->fill))
            return isset($this->values[$name]) ? $this->values[$name] : null;

    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public abstract function apply($model, Repository $repository);
}