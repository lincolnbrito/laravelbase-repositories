<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria\Criterias;

use Illuminate\Database\Eloquent\Model;
use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

class WhereBetween extends Criteria
{
    private $column;

    private $values;

    public function __construct($column, $values)
    {
        $this->column = $column;
        $this->values = $values;
    }

    public function apply(Model $model, Repository $repository)
    {
        return $model->whereBetween($this->column, $this->value);
    }
}