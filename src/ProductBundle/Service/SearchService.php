<?php

namespace ProductBundle\Service;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Result;
use Elastica\ResultSet;
use Elastica\Script\Script;
use Elastica\SearchableInterface;
use Elastica\Suggest\Term;

class SearchService
{

    private $esShop;

    public function __construct(SearchableInterface $esShop)
    {
        $this->esShop = $esShop;
    }

    public function test1()
    {
        $results = [];

        return $this->getResult($results);
    }

    public function test2()
    {
        $results = [];

        return $this->getResult($results);
    }

    public function test3()
    {
        $results = [];

        return $this->getResult($results);
    }

    public function test4()
    {
        $results = [];

        return $this->getResult($results);
    }

    public function test5()
    {
        $results = [];

        return $this->getResult($results);
    }

    public function test6()
    {
        $results = [];

        return $this->getResult($results);
    }

    public function test7()
    {
        $results = [];

        return $this->getResult($results);
    }

    public function test8()
    {
        $results = [];

        return $this->getResult($results);
    }

    private function getResult($resultSet)
    {
        return array_map(function ($value) {
            return $value;
        }, $resultSet);
    }

}