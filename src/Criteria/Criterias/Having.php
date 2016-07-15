<?php
namespace LincolnBrito\LaravelBaseRepositories\Criteria\Criterias;

use Illuminate\Database\Eloquent\Model;
use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface as Repository;

class Having extends Criteria
{

    private $column;

    private $operator;

    private $value;

    private $boolean;

    public function __construct($column, $operator = null, $value = null, $boolan = 'and')
    {
        $this->column = $column;
        $this->operator = $operator;
        $this->value = $value;
        $this->boolean = $boolan;
    }

    public function apply(Model $model, Repository $repository)
    {
        return $model->having($this->column, $this->operator, $this->value, $this->boolean);
    }
}