<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria;

use Illuminate\Http\Request;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

abstract class Criteria {

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public abstract function apply($model, Repository $repository);
}