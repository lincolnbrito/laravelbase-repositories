<?php
namespace LincolnBrito\LaravelBaseRepositories\Eloquent;

use LincolnBrito\LaravelBaseRepositories\Contracts\CriteriaInterface;
use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface;
use LincolnBrito\LaravelBaseRepositories\Exceptions\RepositoryException;
use LincolnBrito\LaravelBaseRepositories\Exceptions\CriteriaException;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Container\Container as App;

/**
 * Class Repository
 * @package LincolnBrito\LaravelBaseRepositories\Eloquent
 */
abstract class Repository implements RepositoryInterface, CriteriaInterface {

    /** @var  App */
    private $app;

    /** @var  \Illuminate\Database\Eloquent\Model */
    protected $model;

    /** @var Collection */
    protected $criteria;

    /** @var bool */
    protected $skipCriteria = false;

    /**
     * Repository constructor.
     *
     * @param App $app
     * @param Collection $collection
     */
    public function __construct(App $app, Collection $collection) {
        $this->app = $app;
        $this->criteria = $collection;
        $this->resetScope();
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    abstract function model();

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*')){
        $this->applyCriteria();
        return $this->model->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*')) {
        $this->applyCriteria();
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data) {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id") {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param array $ids
     * @return int
     */
    public function delete(array $ids) {
        return $this->model->destroy($ids);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*')) {
        $this->applyCriteria();
        return $this->model->find($id, $columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*')) {
        $this->applyCriteria();
        return $this->model->where($attribute, '=', $value)->get($columns);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder | RepositoryException;
     * @throws RepositoryException
     */
    public function makeModel() {
        $model = $this->app->make($this->model());

        if(!$model instanceof Model)
            return new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model->newQuery();
    }

    /**
     * @return $this
     */
    public function resetScope() {
        $this->skipCriteria(false);
        return $this;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function skipCriteria($status = true) {
        $this->skipCriteria = $status;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getCriteria() {
        return $this->criteria;
    }

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function getByCriteria(Criteria $criteria) {
        $this->model = $criteria->apply( $this->model, $this );
        return $this;
    }

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function pushCriteria(Criteria $criteria) {
        $this->criteria->push($criteria);
        return $this;
    }

    /**
     * @return $this
     */
    public function applyCriteria() {
        if( $this->skipCriteria() === true )
            return $this;

        foreach ($this->getCriteria() as $criteria) {
            if( $criteria instanceof Criteria)
               $this->model = $criteria->apply( $this->model, $this);
        }

        return $this;
    }

    /**
     * @param Request $request
     * @return $this
     * @throws CriteriaException
     */
    public function search(Request $request) {
        $namespace = substr(get_called_class(), 0, strrpos(get_called_class(), '\\'))."\\Criterias\\";

        foreach ($request->all() as $criteriaName => $value) {
            $className = $namespace.str_replace(' ', '', ucwords(str_replace('_', ' ', $criteriaName)));
            if(!class_exists($className))
                throw new CriteriaException("The criteria class $className doesn't exists");
            $this->pushCriteria($this->app->make($className,[$value]));
        }

        return $this;
    }
}