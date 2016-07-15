<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria\Criterias;

use Illuminate\Database\Eloquent\Model;
use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

class WithRelations extends Criteria
{
    private $relations;

    public function __construct($relations)
    {
        $this->relations = $relations;
    }

    public function apply(Model $model, Repository $repository)
    {
        return $model->with($this->relations);
    }
}