<?php
namespace ElasticaBundle\SearchRepository;

use FOS\ElasticaBundle\Repository;

class MenuRepository extends Repository {
    
    public function searchPlates($state,$city,$amenities,$categories){
     $query = new \Elastica\Query\BoolQuery();
        $query->setMinimumNumberShouldMatch(1);
        if($state!=null){
             
        
            
            $queryTerm=new \Elastica\Query\Term(array('state' => array('value' => $state)));          
            $query->addMust($queryTerm);
        
         }
         
         if($city!=null){
             
            
            $queryTerm=new \Elastica\Query\Term(array('city' => array('value' => $city)));            
            $query->addMust($queryTerm);
             
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
                
        if ($categories != null) {
            $query->setMinimumNumberShouldMatch(1);
            foreach ($categories as $category) {
                $queryTerm = new \Elastica\Query\Term(array('menuCategory.id' => array('value' => $category)));
                $query->addShould($queryTerm);
            }
           
        }
                
        $parent = new \Elastica\Query\HasParent($query,'restaurant');
        
        $menus = $this->find($parent,10000);
        $array = array();
        foreach($menus as $menu){
            array_push($array, $menu->getId());
        }
        
           return $array;
    }
}
