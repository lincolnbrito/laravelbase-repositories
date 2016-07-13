<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria\Criterias;

use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

class HasRelationshipCriteria extends Criteria
{

    /** @var  string */
    protected $relationship;

    /**
     * HasRelationshipCriteria constructor.
     * @param $relationship
     */
    public function __construct($relationship)
    {
        $this->relationship = $relationship;
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $query = $model->has($this->relationship);
        return $query;
    }
}