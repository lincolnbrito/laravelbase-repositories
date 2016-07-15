<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria;

use Illuminate\Database\Eloquent\Model;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

abstract class Criteria
{
     /**
     * @param Model $model
     * @param Repository $repository
     * @return mixed
     */
    abstract public function apply($model, Repository $repository);
}