<?php
namespace LincolnBrito\LaravelBaseRepositories\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Container\Container as App;
use LincolnBrito\LaravelBaseRepositories\Search\Search;

use LincolnBrito\LaravelBaseRepositories\Contracts\CriteriaInterface;
use LincolnBrito\LaravelBaseRepositories\Contracts\SearchInterface;
use LincolnBrito\LaravelBaseRepositories\Contracts\RepositoryInterface;
use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;

/**
 * Class Repository
 * @package LincolnBrito\LaravelBaseRepositories\Eloquent
 */
abstract class Repository extends AbstractRepository implements RepositoryInterface, CriteriaInterface, SearchInterface
{

    /**
     * @var Collection
     */
    protected $criterias;

    /**
     * @var bool
     */
    protected $skipCriteria = false;

    /**
     * BaseRepository constructor.
     * @param App $app
     * @param Collection $criterias
     */
    public function __construct(App $app, Collection $criterias)
    {
        $this->criterias = $criterias;
        parent::__construct($app);
    }

    /**
     * @return mixed
     */
    final public function getModelClass()
    {
        return $this->model();
    }

    /**
     * @return mixed
     */
    abstract public function model();


    /**
     * @return $this
     */
    public function resetScope()
    {
        $this->skipCriteria(false);
        return $this;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function skipCriteria($status = true)
    {
        $this->skipCriteria = $status;
        return $this;
    }

    /**
     * Apply a criteria to repository
     * @return $this
     */
    public function applyCriteria()
    {
        if ($this->skipCriteria === true)
            return $this;

        foreach ($this->getCriteria() as $criteria) {
            if ($criteria instanceof Criteria)
                $this->model = $criteria->apply($this->model, $this);
        }

        return $this;
    }

    /**
     * Get all criterias
     *
     * @return Collection
     */
    public function getCriteria()
    {
        return $this->criterias;
    }

    /**
     * Push a criteria to repository
     *
     * @param Criteria $criteria
     * @return $this
     */
    public function pushCriteria(Criteria $criteria)
    {
        $this->criterias->push($criteria);
        return $this;
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        $this->applyCriteria();
        return $this->model->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*'))
    {
        $this->applyCriteria();
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param array $ids
     * @return int
     */
    public function delete(array $ids)
    {
        return $this->model->destroy($ids);
    }

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->applyCriteria();
        return $this->model->find($id, $columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*'))
    {
        $this->applyCriteria();
        return $this->model->where($attribute, '=', $value)->get($columns);
    }

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function getByCriteria(Criteria $criteria)
    {
        $this->model = $criteria->apply($this->model, $this);
        return $this;
    }

    /**
     * @param Search $search
     * @param array $columns
     * @return $this
     */
    public function search(Search $search, $columns = ['*'])
    {
        $search->apply($this);
        $this->applyCriteria();

        return $this->model->get($columns);
    }


}