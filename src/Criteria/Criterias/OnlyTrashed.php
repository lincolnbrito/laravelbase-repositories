<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria\Criterias;

use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

class OnlyTrashed extends Criteria
{
    public function apply($model, Repository $repository)
    {
        return $model->onlyTrashed();
    }
}