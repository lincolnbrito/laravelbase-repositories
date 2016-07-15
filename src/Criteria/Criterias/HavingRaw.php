<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria\Criterias;

use Illuminate\Database\Eloquent\Model;
use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

class HavingRaw extends Criteria
{

    private $sql;

    private $bindings;

    private $boolean;

    public function __construct($sql, array $bindigns = [], $boolan = 'and')
    {
        $this->sql = $sql;
        $this->bindings = $bindigns;
        $this->boolean = $boolan;
    }

    public function apply(Model $model, Repository $repository)
    {
        return $model->havingRaw($this->sql, $this->bindings, $this->boolean);
    }
}