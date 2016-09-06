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

class MunicipaltyRepository  extends EntityRepository {
    
    /**
     * 
     * @param integer $id
     * @return VnzlaStatesBundle\Municipalty
     */
    public function searchMunicipalties($id) {
        
        return $this->getEntityManager()
            ->createQuery('SELECT c FROM VnzlaStatesBundle:Municipalty WHERE c.state = :state')
            ->setParameter('state',$id)
            ->getResult();
    }
    
}
