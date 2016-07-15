<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria\Criterias;

use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

class GroupBy extends Criteria
{

    private $column;

    public function __construct($column)
    {
        $this->column = $column;
    }

    public function apply($model, Repository $repository)
    {
        return $model->groupBy($this->column);
    }
}