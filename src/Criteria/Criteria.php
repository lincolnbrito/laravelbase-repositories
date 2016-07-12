<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria;

use Illuminate\Http\Request;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

abstract class Criteria {

    protected $params;

    /**
     * Criteria constructor.
     * @param $params
     */
    public function __construct(Request $params) {
        $this->params = $params;
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public abstract function apply($model, Repository $repository);
}