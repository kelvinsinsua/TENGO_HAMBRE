<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ElasticaBundle\SearchRepository;

use FOS\ElasticaBundle\Repository;

class ClientRepository extends Repository{
    public function searchID($ids) {
        $query = new \Elastica\Query\Ids();
        $query->setIds($ids);
        $results = $this->find($query,100);

        return $results;
    }
}
