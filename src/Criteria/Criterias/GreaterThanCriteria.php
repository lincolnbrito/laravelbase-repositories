<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria\Criterias;

use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

class GreaterThanCriteria extends Criteria
{

    /** @var  string */
    protected $attribute;

    /** @var  mixed */
    protected $value;

    /**
     * LessThan constructor.
     * @param $atribute
     * @param $value
     */
    public function __construct($atribute, $value)
    {
        $this->attribute = $atribute;
        $this->value = $value;
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $query = $model->where($this->attribute, '>', $this->value);
        return $query;
    }
}