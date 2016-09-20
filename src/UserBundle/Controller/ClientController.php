<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UserBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ClientController extends FOSRestController implements 
    ClassResourceInterface 
{
    /**
     * GET Route annotation.
     * @Get("/api/findclient")
     */
    public function getClientAction(
            Request $request
            ) { 
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $id=$user->getClient()->getId();
        
        if($id==null){
            throw new BadRequestHttpException(); 
        }
        $client = $this->clientRepository()->searchID($id);
        $r = $this->encoder($client);
        
        return new JsonResponse($r);
        
    }
    
    public function clientRepository(){
        
        $repositoryManager = $this->container->get('fos_elastica.manager');
        $repository = $repositoryManager->getRepository('UserBundle:Client');
        return $repository;
        
    }
    
    public function encoder($entity) {
       $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $serializer = new Serializer(array($normalizer), array($encoder));

        foreach ($entity as $ent) {
            
                
            
        }
        $normalizer->setIgnoredAttributes(array(
                    'user',
                    'preferences',
                    'orders'
                ));
                $jsonEntity = $serializer->serialize($ent, 'json');
        return $jsonEntity;
        
        
    }
}
