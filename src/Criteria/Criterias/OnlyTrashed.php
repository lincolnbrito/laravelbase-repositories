<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria\Criterias;

use Illuminate\Database\Eloquent\Model;
use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

class OnlyTrashed extends Criteria
{
    public function apply(Model $model, Repository $repository)
    {
        return $model->onlyTrashed();
    }
}