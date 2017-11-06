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
        $results = $this->esShop->search(new Query\Term(['price' => 50]))
            ->getResults();

        return $this->getResult($results);
    }

    public function test2()
    {
        $results = $this->esShop->search(new Query\Terms('quantity', [1, 2, 3, 4]))
            ->getResults();

        return $this->getResult($results);
    }

    public function test3()
    {
        $query = new BoolQuery();
        $rangePrice = (new Query\Range())->addField(
            'price',
            ['gt' => 0, 'lt' => 10]
        );

        $rangeQuantity = (new Query\Range())->addField(
            'quantity',
            ['gte' => 400]
        );

        $query->addMust($rangePrice);
        $query->addMust($rangeQuantity);

        $results = $this->esShop->search($query)->getResults();

        return $this->getResult($results);
    }

    public function test4()
    {
        $statusTerm = (new Query\Terms('status_id.enabled', [true]));
        $results = $this->esShop->search($statusTerm)->getResults();

        return $this->getResult($results);
    }

    public function test5()
    {
        $boolQuery = new BoolQuery();
        $boolQuery
            ->addMust(new Query\Term(['notes.note' => 2]))
            ->addMust(new Query\Match('notes.note_category.name', 'Smak'));

        $nestedQuery = (new Query\Nested())
            ->setPath('notes')
            ->setQuery($boolQuery);

        $results = $this->esShop->search($nestedQuery)->getResults();

        return $this->getResult($results);
    }

    public function test6()
    {
        $boolQuery = new Query();
        $match = new Query\Match('description', 'salm');
        $highlights = [
            'pre_tags'  => ['<b>'],
            'post_tags' => ['</b>'],
            'fields'    => [
                'description' => [
                    'fragment_size'       => 20,
                    'number_of_fragments' => 3,
                    'fragmenter'          => 'simple'
                ]
            ]
        ];
        $boolQuery->setHighlight($highlights);
        $boolQuery->setQuery($match);

        $results = $this->esShop->search($boolQuery)->getResults();

        return $this->getResult($results);
    }

    public function test7()
    {
        $query = new Query();
        $script = new Script('doc[\'quantity\'].value < params.maxQuantity ? _score * params.factor : _score', [
            'factor'      => 2,
            'maxQuantity' => 3
        ]);
        $functionScore = new Query\FunctionScore();
        $functionScore->addScriptScoreFunction($script);
        $functionScore->setQuery(new Query\Match('description', 'salmiakki'));

        $query->setQuery($functionScore);

        $results = $this->esShop->search($query)->getResults();

        return $this->getResult($results);
    }

    public function test8()
    {
        $boolQuery = new BoolQuery();
        $boolQuery
            ->addMust(new Query\Term(['status_id.id' => 3]))
            ->setBoost(2);

        $mainQuery = new BoolQuery();
        $rangePrice = (new Query\Range())->addField(
            'price',
            ['lt' => 50]
        );

        $mainQuery->addShould($boolQuery)->addShould($rangePrice);
        $results = $this->esShop->search($mainQuery)->getResults();

        return $this->getResult($results);
    }

    private function getResult($resultSet)
    {
        return array_map(function ($value) {
            /** @var $value Result */
            $source['id'] = $value->getId();
            $source['score'] = $value->getScore();
            $source['data'] = $value->getSource();
            $source['highlights'] = $value->getHighlights();

            return $source;
        }, $resultSet);
    }

}