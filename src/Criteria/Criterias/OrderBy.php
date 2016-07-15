<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria\Criterias;

use Illuminate\Database\Eloquent\Model;
use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

class OrderBy extends Criteria
{
    private $column;

    private $direction;

    public function __construct($column, $direction = 'asc')
    {
        $this->column = $column;
        $this->direction = $direction;
    }

    public function apply(Model $model, Repository $repository)
    {
        return $model->orderBy($this->column, $this->direction);
    }
}