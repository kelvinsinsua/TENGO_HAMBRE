<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace VnzlaStatesBundle\Repository;

use FOS\ElasticaBundle\Repository;

class ParishRepository extends Repository {

    public function searchParishes($id) {
        $queryId = new \Elastica\Query\Ids();
        $queryId->addId($id);       
        
        $query = new \Elastica\Query\BoolQuery();
        $query->setMinimumNumberShouldMatch(1);
        
        $parent = new \Elastica\Query\HasParent($queryId, 'municipalty');
        
        $query->addShould($parent);
        
        $results = $this->find($query,200);    
        return $results;
    }
}
