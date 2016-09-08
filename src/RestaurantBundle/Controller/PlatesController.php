<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RestaurantBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PlatesController extends FOSRestController implements 
    ClassResourceInterface 
{
    /**
     * GET Route annotation.
     * @Get("/api/findplates")
     */
    public function getPlatesAction(
            Request $request
            ) {
        
        $state=$request->get('state');
        $city=$request->get('city');
        $categories=json_decode($request->get('categories'));
        $amenities=json_decode($request->get('amenities'));
        $page=$request->get('page');
        $pagination = $this->get('knp_paginator');
        $menuRepository = $this->menusRepository();
        
        //1=PAGINATION  2=NUMERO DE PAGINA 3=ACTIVIDADES 4=COMODIDADES
        //5=ESTADO  6=CIUDADES
        $plates = $this->restaurantRepository()->searchRestaurant(
                $pagination,
                $page,
                $categories,
                $amenities,
                $state,
                $city,
                $menuRepository
                );   
        
        $r = $this->encoder($plates);
        return new JsonResponse($r);
        
    }
    
     public function platesRepository(){
        
        $repositoryManager = $this->container->get('fos_elastica.manager');
        $repository = $repositoryManager->getRepository('RestaurantBundle:Plates');
        return $repository;
        
    }
     public function menusRepository(){
        
        $repositoryManager = $this->container->get('fos_elastica.manager');
        $repository = $repositoryManager->getRepository('RestaurantBundle:Menu');
        return $repository;
        
    }
    
    public function encoder($entity) {
       $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $serializer = new Serializer(array($normalizer), array($encoder));

        foreach ($entity as $ent) {
            foreach ($ent->getMenu()->getRestaurant()->getAmenities() as $amenity) {
                $normalizer->setIgnoredAttributes(array(
                    'restaurant'
                ));
                $jsonEntity = $serializer->serialize($amenity, 'json');
            }
            $normalizer->setIgnoredAttributes(array(
                'user',
                'menus',
                'amenities',
                'web',
                'about',
                'phone',
                'facebook',
                'twitter',
                'deletedAt',
                'lat',
                'lon',
            ));
            $em = $this->getDoctrine()->getManager();
            if ($ent->getMenu()->getRestaurant()->getState() != null) {
                $state = $em->getRepository('VnzlaStatesBundle:State')->find($ent->getMenu()->getRestaurant()->getState());
                $ent->getMenu()->getRestaurant()->setStateName($state->getState());
            }

            if ($ent->getMenu()->getRestaurant()->getCity() != null) {
                $city = $em->getRepository('VnzlaStatesBundle:City')->find($ent->getMenu()->getRestaurant()->getCity());


                $ent->getMenu()->getRestaurant()->setCityName($city->getCity());
            }

            $jsonEntity = $serializer->serialize($ent->getMenu()->getRestaurant(), 'json');
            $normalizer->setIgnoredAttributes(array(
                'menus'
            ));
            $jsonEntity = $serializer->serialize($ent->getMenu()->getMenuCategory(), 'json');
            $normalizer->setIgnoredAttributes(array(
                'plates',
                'about',
                'available',
                'name',
                'id'
            ));
            $jsonEntity = $serializer->serialize($ent->getMenu(), 'json');
            
            
        
        }

        
        $normalizer->setIgnoredAttributes(array(
            'ingredients'
        ));
        $jsonEntity = $serializer->serialize($entity, 'json');

        return $jsonEntity;
        
        
    }
}
