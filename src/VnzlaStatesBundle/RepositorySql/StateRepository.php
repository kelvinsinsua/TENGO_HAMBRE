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

class StateRepository  extends EntityRepository {
    
    /**
     * 
     *
     * @return VnzlaStatesBundle\State
     */
    public function searchStates() {
        
        return $this->getEntityManager()
            ->createQuery('SELECT * FROM VnzlaStatesBundle:State')
            ->getResult();
    }
    
}
