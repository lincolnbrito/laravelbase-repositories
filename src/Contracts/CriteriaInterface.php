<?php
namespace LincolnBrito\LaravelBaseRepositories\Contracts;

use Illuminate\Http\Request;
use LincolnBrito\LaravelBaseRepositories\Criteria\Criteria;

/**
 * Class CriteriaInterface
 * @package LincolnBrito\LaravelBaseRepositories\Contracts
 */
interface CriteriaInterface
{

    /**
     * @param bool $status
     * @return mixed
     */
    public function skipCriteria($status = true);

    /**
     * @return mixed
     */
    public function getCriteria();

    /**
     * @param Criteria $criteria
     * @return mixed
     */
    public function getByCriteria(Criteria $criteria);

    /**
     * @param Criteria $criteria
     * @return mixed
     */
    public function pushCriteria(Criteria $criteria);

    /**
     * @return mixed
     */
    public function applyCriteria();

    /**
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request);

}