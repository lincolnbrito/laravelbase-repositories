<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria;

use Illuminate\Database\Eloquent\Model;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

abstract class Criteria
{
    protected $_values;
    protected $fill;

    public function __set($name, $value)
    {
        if(in_array($name, $this->fill))
            $this->_values[$name] = $value;
    }

    public function __get($name)
    {
        if (in_array($name, $this->fill))
            return isset($this->_values[$name]) ? $this->_values[$name] : null;

        return null;
    }

    /**
     * @param Model $model
     * @param Repository $repository
     * @return mixed
     */
    abstract public function apply(Model $model, Repository $repository);
}