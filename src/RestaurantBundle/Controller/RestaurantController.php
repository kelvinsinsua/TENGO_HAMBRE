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

class RestaurantController extends FOSRestController implements 
    ClassResourceInterface 
{
    /**
     * GET Route annotation.
     * @Get("/api/findrestaurants")
     */
    public function getRestaurantsAction(
            Request $request
            ) {
        
        $state=$request->get('state');
        $city=$request->get('city');
        $categories=json_decode($request->get('categories'));
        $amenities=json_decode($request->get('amenities'));
        $page=$request->get('page');
        $lat=$request->get('lat');
        $lon=$request->get('lon');
        $radius=$request->get('radius');
        $pagination = $this->get('knp_paginator');
        
        //1=PAGINATION  2=NUMERO DE PAGINA 3=ACTIVIDADES 4=COMODIDADES
        //5=ESTADO  6=CIUDADES
        $restaurants = $this->restaurantRepository()->searchRestaurant(
                $pagination,
                $page,
                $categories,
                $amenities,
                $state,
                $city,
                $lat,
                $lon,
                $radius
                );   
        
        $r = $this->encoder($restaurants);
        return new JsonResponse($r);
        
    }
    
    public function restaurantRepository(){
        
        $repositoryManager = $this->container->get('fos_elastica.manager');
        $repository = $repositoryManager->getRepository('RestaurantBundle:Restaurant');
        return $repository;
        
    }
    
    public function encoder($entity) {
       
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();      
        
        $serializer = new Serializer(array($normalizer), array($encoder));
        
        foreach($entity as $ent){
            foreach($ent->getMenus() as $menu){
            $normalizer->setIgnoredAttributes(array(
                'menus'
            ));
            
            $jsonEntity=$serializer->serialize($menu->getMenuCategory(), 'json');
            }
            $normalizer->setIgnoredAttributes(array(
                'restaurant',
                'plates',
                'available',
                'about'
            ));
            
            $jsonEntity=$serializer->serialize($ent->getMenus(), 'json');
            $normalizer->setIgnoredAttributes(array(
                'restaurant',
                'drinks'
            ));
            
            $jsonEntity=$serializer->serialize($ent->getDrinkCategories(), 'json');
            
            $normalizer->setIgnoredAttributes(array(
                'restaurant'
            ));
            
            $jsonEntity=$serializer->serialize($ent->getAmenities(), 'json');
            
            
        }
        
        $normalizer->setIgnoredAttributes(array(
            'user',
            'aditionals',
            'schedules'
            ));
        $em=$this->getDoctrine()->getManager();
        foreach($entity as $ent){
            if($ent->getState()!=null){
        $state = $em->getRepository('VnzlaStatesBundle:State')->find($ent->getState());
            $ent->setStateName($state->getState());
        
            }
             if($ent->getCity()!=null){
        $city = $em->getRepository('VnzlaStatesBundle:City')->find($ent->getCity());       
        
        $ent->setCityName($city->getCity());
             }
            
        }
        $jsonEntity=$serializer->serialize($entity, 'json');
        
        return $jsonEntity;
        
    }
}
