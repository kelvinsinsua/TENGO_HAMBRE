<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ElasticaBundle\SearchRepository;

use FOS\ElasticaBundle\Repository;

class ReputationRestaurantRepository extends Repository{
    
     public function searchReputation($pagination,$page,$ids) {
        $query = new \Elastica\Query\Ids();
        $query->setIds($ids);
        
        $parent = new \Elastica\Query\HasParent($query,'restaurant');
        $q = new \Elastica\Query();
        $q->setQuery($parent);
        $q->addSort(array('date' => array('order' => 'desc')));
        $reputations = $this->createPaginatorAdapter($q);        
        $response = $pagination->paginate($reputations, $page, 10);

        return $response;
    }
}
