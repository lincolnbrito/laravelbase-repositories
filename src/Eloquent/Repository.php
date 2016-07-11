<?php
namespace LincolnBrito\LaravelBaseRepositories\Eloquent;

use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

/**
 * Class Repository
 * @package LincolnBrito\LaravelBaseRepositories\Eloquent
 */
abstract class Repository implements RepositoryInterface {

    /** @var  App */
    private $app;

    /** @var  \Illuminate\Database\Eloquent\Model */
    protected $model;

    /**
     * Repository constructor.
     *
     * @param App $app
     */
    public function __construct(App $app) {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract function model();

    public function makeModel() {
        $model = $this->app->make($this->model());

        if(!$model instanceof Model)
            return new RepositoryExcpetion();
    }

}