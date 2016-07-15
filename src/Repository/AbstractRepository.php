<?php
namespace LincolnBrito\LaravelBaseRepositories\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

use LincolnBrito\LaravelBaseRepositories\Exceptions\RepositoryException;

abstract class AbstractRepository
{
    /**
     * @var App
     */
    protected $app;

    /**
     * @var Model
     */
    protected $model;

    /**
     * AbstractRepository constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * @return Model
     * @throws RepositoryException
     */
    final protected function makeModel()
    {
        $model = $this->app->make($this->getModelClass());

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->getModelClass()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $this->setModel($model);
    }

    /**
     * @return Model
     */
    protected function getModel()
    {
        return $this->model;
    }

    /**
     * @param Model $model
     * @return Model
     */
    protected function setModel($model)
    {
        return $this->model = $model;
    }

    /**
     * @return mixed
     */
    abstract public function getModelClass();
}