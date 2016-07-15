<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria\Criterias;

use Illuminate\Database\Eloquent\Model;
use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

class GroupBy extends Criteria
{

    private $column;

    public function __construct($column)
    {
        $this->column = $column;
    }

    public function apply(Model $model, Repository $repository)
    {
        return $model->groupBy($this->column);
    }
}