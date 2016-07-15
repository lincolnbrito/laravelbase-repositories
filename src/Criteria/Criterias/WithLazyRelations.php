<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria\Criterias;

use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

class WithLazyRelations extends Criteria
{
    private $relations;

    public function __construct($relations)
    {
        $this->relations = $relations;
    }

    public function apply($model, Repository $repository)
    {
        return $model->load($this->relations);
    }
}