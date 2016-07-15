<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria\Criterias;

use Illuminate\Database\Eloquent\Model;
use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

class Take extends Criteria
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function apply(Model $model, Repository $repository)
    {
        return $model->take($this->value);
    }
}