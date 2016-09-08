<?php

namespace ElasticaBundle\SearchRepository;

use FOS\ElasticaBundle\Repository;

class PlateRepository extends Repository {
    
    public function searchPlate(
            $pagination,
            $page = 1,
            $categories = null,
            $amenities=null,
            $state = null,
            $city = null,
            $menuRepository
            ){
        
        $query = new \Elastica\Query\BoolQuery();
        
        
        if($amenities != null||$state!=null||$city != null ||$categories != null){
        $ids=$menuRepository->searchPlates($state,$city,$amenities,$categories);
        if(count($ids)==0){
            return [];
        }
        $queryId = new \Elastica\Query\BoolQuery();
        $queryId->setMinimumNumberShouldMatch(1);
        foreach($ids as $id){
            $queryMatch1 = new \Elastica\Query\Term(array('menu.id' => array('value' => $id)));
            $queryId->addShould($queryMatch1);
        }
        
        $query2=new \Elastica\Query\BoolQuery();
        $query2->addShould($queryId);
        $query2->setMinimumNumberShouldMatch(1);
        $sche=$this->find($query2,10000);
        $a = array();
        foreach($sche as $s){
            array_push($a, $s->getId());
        }
//        return $a;
        $querySI=new \Elastica\Query\Ids();
        $querySI->setIds($a);
        
        $query->addMust($querySI);
        
        $q = new \Elastica\Query();
//        $q->addSort(array('startTime' => array('order' => 'asc')));
        $q->setQuery($query);
        
        $plates = $this->createPaginatorAdapter($q);
        $response = $pagination->paginate($plates, $page, 10);

        return $response;
        }else{
            $query = new \Elastica\Query\MatchAll();
            $q = new \Elastica\Query();
//        $q->addSort(array('startTime' => array('order' => 'asc')));
        $q->setQuery($query);
        
        $plates = $this->createPaginatorAdapter($q);
        $response = $pagination->paginate($plates, $page, 10);

        return $response;
        }
        
        
    }
    
}
