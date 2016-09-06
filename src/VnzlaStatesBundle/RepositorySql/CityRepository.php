<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserRepository
 *
 * @author gregol
 */

namespace VnzlaStatesBundle\RepositorySql;
use Doctrine\ORM\EntityRepository;

class CityRepository  extends EntityRepository {
    
    /**
     * 
     * @param integer $id
     * @return VnzlaStatesBundle\City
     */
    public function searchCities($id) {
        
        return $this->getEntityManager()
            ->createQuery('SELECT c FROM VnzlaStatesBundle:City WHERE c.state = :state')
            ->setParameter('state',$id)
            ->getResult();
    }
    
}
