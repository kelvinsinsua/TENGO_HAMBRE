<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace VnzlaStatesBundle\Repository;

use FOS\ElasticaBundle\Repository;

class StateRepository extends Repository {

    public function searchStates() {
        $queryBool = new \Elastica\Query\BoolQuery();
        $query = new \Elastica\Query\MatchAll();        
        $queryBool->addShould($query);
        
        
        $results = $this->find($queryBool,30);    
        return $results;
    }
}
