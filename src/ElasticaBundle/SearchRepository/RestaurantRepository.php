<?php

namespace ElasticaBundle\SearchRepository;

use FOS\ElasticaBundle\Repository;

class RestaurantRepository extends Repository {
    
    public function searchRestaurant(
            $pagination,
            $page = 1,
            $categories = null,
            $amenities=null,
            $state = null,
            $city = null,
            $lat = null,
            $lon = null,
            $radius = null
            ) {

        $query = new \Elastica\Query\BoolQuery();
//        $query->setMinimumNumberShouldMatch(1);
        
         if($state!=null){
             
        
            
            $queryTerm=new \Elastica\Query\Term(array('state' => array('value' => $state)));          
            $query->addMust($queryTerm);
        
         }
         
         if($city){
             
            
            $queryTerm=new \Elastica\Query\Term(array('city' => array('value' => $city)));            
            $query->addMust($queryTerm);
             
         }
         
//         $queryEnabled=new \Elastica\Query\Term(array('enabled' => array('value' => true)));            
//            $query->addMust($queryEnabled);
            
            if($categories!=null){
             
         $queryBool = new \Elastica\Query\BoolQuery();
         $queryBool->setMinimumNumberShouldMatch(1); 
         
         foreach($categories as $category){
         $queryTerm=new \Elastica\Query\Term(array('menuCategory.id' => array('value' => $category)));
         $queryBool->addShould($queryTerm);
         }         
         $queryChild= new \Elastica\Query\HasChild($queryBool,'menu');
         $query->addMust($queryChild);
         }
         
         
         if($amenities!=null){
             
         $queryBool = new \Elastica\Query\BoolQuery();
         $queryBool->setMinimumNumberShouldMatch(1);
         
         foreach($amenities as $amenity){
         $queryTerm=new \Elastica\Query\Term(array('amenities.id' => array('value' => $amenity)));
         $queryBool->addShould($queryTerm);
         }   
         
         $queryChild= new \Elastica\Query\Nested();
         $queryChild->setPath('amenities');         
         $queryChild->setQuery($queryBool);         
         $query->addMust($queryChild);
         }
//        $queryTime = new \Elastica\Query\BoolQuery();
//            
//                
//                $range1 = new \Elastica\Query\Range('deletedAt', array(
//                    'gte' => '1990-01-01T00:00:00+00:00'
//                        )
//                );
//                $queryTime->addMust($range1);
//                $query->addMustNot($queryTime);
                
                if($lat!=null){
                $filterLocation = new \Elastica\Filter\GeoDistance('location', array('lat' => $lat,
             'lon' => $lon), $radius);
        
        $queryFiltered = new \Elastica\Query\Filtered($query, $filterLocation);
        
        $studios = $this->find($queryFiltered,1000);
        return $studios;
                }
        $q = new \Elastica\Query();
        $q->addSort(array('reputationTotal' => array('order' => 'desc')));
        $q->setQuery($query);        
        $studios = $this->createPaginatorAdapter($q);
        $response = $pagination->paginate($studios, $page, 10);

        return $response;
            
            }
}
