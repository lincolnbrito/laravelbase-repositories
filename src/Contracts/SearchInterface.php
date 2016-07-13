<?php
namespace LincolnBrito\LaravelBaseRepositories\Contracts;
use LincolnBrito\LaravelBaseRepositories\Search\Search;

/**
 * Class SearchInterface
 * @package LincolnBrito\LaravelBaseRepositories\Contracts
 */
interface SearchInterface
{
    public function search(Search $search, $columns = ['*']);
}