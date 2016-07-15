<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria\Criterias;

use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

class Limit extends Criteria
{

    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function apply($model, Repository $repository)
    {
        return $model->limit($this->value);
    }
}