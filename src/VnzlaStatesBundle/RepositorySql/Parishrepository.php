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

class ParishRepository  extends EntityRepository {
    
    /**
     * 
     * @param integer $id
     * @return VnzlaStatesBundle\Parish
     */
    public function searchParishes($id) {
        
        return $this->getEntityManager()
            ->createQuery('SELECT c FROM VnzlaStatesBundle:Parish WHERE c.municipalty = :municipalty')
            ->setParameter('municipalty',$id)
            ->getResult();
    }
    
}
