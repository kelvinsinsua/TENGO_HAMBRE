<?php

namespace RestaurantBundle\EventListener;

use Dunglas\ApiBundle\Event\DataEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use RestaurantBundle\Entity\ReputationPlate;
use RestaurantBundle\Entity\ReputationRestaurant;

class ReputationCrudListener {
   protected $manager;

    public function __construct(EntityManager $manager) {
        $this->manager = $manager;
    }
    
     public function onPostCreate(DataEvent $event) {
       
        $data = $event->getData();

        if ($data instanceof ReputationPlate) {
            $rp= $data;
        $plate = $rp->getPlate();
        
        $t = 0;
        foreach($plate->getReputations() as $r){
        $t +=$r->getCalification();
        }
        $reputationTotal = $t/count($plate->getReputations());
        
        $plate->setReputationTotal($reputationTotal);
        $this->manager->flush();
        }
        
        if ($data instanceof ReputationRestaurant) {
           $rp= $data;
        $restaurant = $rp->getRestaurant();
        
        $t = 0;
        foreach($restaurant->getReputations() as $r){
        $t +=$r->getCalification();
        }
        $reputationTotal = $t/count($restaurant->getReputations());
        
        $restaurant->setReputationTotal($reputationTotal);
        $this->manager->flush(); 
            
        }
        
        }
     public function onPreCreate(DataEvent $event) {
       
        $data = $event->getData();

        if ($data instanceof ReputationPlate) {
            $rp= $data;
            $rp->setDate(new \DateTime());
        }
        
        if ($data instanceof ReputationRestaurant) {
           $rp= $data;
           $rp->setDate(new \DateTime());
            
        }
        
        }
     public function onPreUpdate(DataEvent $event) {
       
        $data = $event->getData();

        if ($data instanceof ReputationPlate) {
            $rp= $data;
            $rp->setDate(new \DateTime());
        }
        
        if ($data instanceof ReputationRestaurant) {
           $rp= $data;
           $rp->setDate(new \DateTime());
            
        }
        
        }
        
        
     public function onPostUpdate(DataEvent $event) {
       
        $data = $event->getData();

        if ($data instanceof ReputationPlate) {
           $rp= $data;
        $plate = $rp->getPlate();
        
        $t = 0;
        foreach($plate->getReputations() as $r){
        $t +=$r->getCalification();
        }
        $reputationTotal = $t/count($plate->getReputations());
        
        $plate->setReputationTotal($reputationTotal);
        $this->manager->flush(); 
            
        }
        if ($data instanceof ReputationRestaurant) {
           $rp= $data;
        $restaurant = $rp->getRestaurant();
        
        $t = 0;
        foreach($restaurant->getReputations() as $r){
        $t +=$r->getCalification();
        }
        $reputationTotal = $t/count($restaurant->getReputations());
        
        $restaurant->setReputationTotal($reputationTotal);
        $this->manager->flush(); 
            
        }
        
        }
}
