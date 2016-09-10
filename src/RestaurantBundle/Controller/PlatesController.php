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
        $minPrice=$request->get('minPrice');
        $maxPrice=$request->get('maxPrice');
        $categories=json_decode($request->get('categories'));
        $amenities=json_decode($request->get('amenities'));
        $page=$request->get('page');
        $pagination = $this->get('knp_paginator');
        $menuRepository = $this->menuRepository();
        
        //1=PAGINATION  2=NUMERO DE PAGINA 3=ACTIVIDADES 4=COMODIDADES
        //5=ESTADO  6=CIUDADES
        $plates = $this->plateRepository()->searchPlate(
                $pagination,
                $page,
                $categories,
                $amenities,
                $state,
                $city,
                $minPrice,
                $maxPrice,
                $menuRepository
                );   
        
        $r = $this->encoder($plates);
        return new JsonResponse($r);
        
    }
    
     public function plateRepository(){
        
        $repositoryManager = $this->container->get('fos_elastica.manager');
        $repository = $repositoryManager->getRepository('RestaurantBundle:Plate');
        return $repository;
        
    }
     public function menuRepository(){
        
        $repositoryManager = $this->container->get('fos_elastica.manager');
        $repository = $repositoryManager->getRepository('RestaurantBundle:Menu');
        return $repository;
        
    }
    
    public function encoder($entity) {
       $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $serializer = new Serializer(array($normalizer), array($encoder));

        foreach ($entity as $ent) {
            foreach ($ent->getRestaurant()->getAmenities() as $amenity) {
                $normalizer->setIgnoredAttributes(array(
                    'restaurant'
                ));
                $jsonEntity = $serializer->serialize($amenity, 'json');
            }
            foreach ($ent->getRestaurant()->getSchedules() as $sc) {
                $normalizer->setIgnoredAttributes(array(
                    'restaurant'
                ));
                $jsonEntity = $serializer->serialize($sc, 'json');
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
                'drinkCategories',
                'reputations',
                'aditionals',
                'combos'
            ));
            $em = $this->getDoctrine()->getManager();
            if ($ent->getRestaurant()->getState() != null) {
                $state = $em->getRepository('VnzlaStatesBundle:State')->find($ent->getRestaurant()->getState());
                $ent->getRestaurant()->setStateName($state->getState());
            }

            if ($ent->getRestaurant()->getCity() != null) {
                $city = $em->getRepository('VnzlaStatesBundle:City')->find($ent->getRestaurant()->getCity());


                $ent->getRestaurant()->setCityName($city->getCity());
            }
            
            $jsonEntity = $serializer->serialize($ent->getRestaurant(), 'json');
            foreach ($ent->getMenus() as $menu){
            $normalizer->setIgnoredAttributes(array(
                'menus'
            ));
            
            
            $jsonEntity = $serializer->serialize($menu->getMenuCategory(), 'json');
            }
            $normalizer->setIgnoredAttributes(array(
                'plates',
                'available',
                'id',
                'restaurant'
            ));
            $jsonEntity = $serializer->serialize($ent->getMenus(), 'json');
            foreach($ent->getAditionals() as $add){
                $normalizer->setIgnoredAttributes(array(
                    'restaurant',
                    'plates'
            ));
            $jsonEntity = $serializer->serialize($add, 'json');
            }
            
        
        }

        
        $normalizer->setIgnoredAttributes(array(
            'ingredients',
            'reputations',
            'combos'
        ));
        $jsonEntity = $serializer->serialize($entity, 'json');

        return $jsonEntity;
        
        
    }
}
