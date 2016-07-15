<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria\Criterias;

use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

class HasRelation extends Criteria
{
    private $relation;

    private $operator;

    private $value;

    public function __construct($relation, $operator = null, $value = null)
    {
        $this->relation = $relation;
        $this->operator = $operator;
        $this->value = $value;
    }

    public function apply($model, Repository $repository)
    {
        return $model->has($this->relation, $this->operator, $this->value);
    }
}