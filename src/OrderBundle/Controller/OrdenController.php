<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OrderBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use OrderBundle\Entity\Orden;
use OrderBundle\Entity\Item;
use OrderBundle\Entity\Without;
use OrderBundle\Entity\AditionalItem;

class OrdenController extends FOSRestController implements 
    ClassResourceInterface 
{
   /**
     * GET Route annotation.
     * @Get("/api/createorder")
     */
    public function getPlatesAction(
            Request $request
            ) {
        
        try{
        $user = $this->get('security.context')->getToken()->getUser();
        $client = $user->getClient();
        $items=$request->get('items');
        $em = $this->getDoctrine()->getManager();
        
        $order = new Orden();
        $order->setClient($client);
        $order->setDate(new \DateTime());
        $order->setCode('1234567');
        $order->setDescription("hola que hace");
        $order->setRestaurantId(1);
        $order->setSubTotal(0);
        $order->setTotal(0);
        $em->persist($order);
        
        $total = 0;
        foreach($items as $i){
            $plate = $em->getRepository('RestaurantBundle:Plate')->find($i->getId());
            $item = new Item();
            $item->setName($plate->getName());
            $item->setPrice($plate->getPrice());
            $item->setQuantity($i->getQuantity());
            $item->setOrder($order);
            $em->persist($item);
            $total +=($plate->getPrice()*$i->getQuantity());
            
            foreach($i->getAditionals() as $add){
                $adit = $em->getRepository('RestaurantBundle:Aditional')->find($add->getId());
                $aditional = new AditionalItem();
                $aditional->setItem($item);
                $aditional->setName($adit->getName());
                $aditional->setPrice($adit->getPrice());
                $aditional->setQuiantity($add->getQuantity());
                $em->persist($aditional);
                 $total +=($adit->getPrice()*$add->getQuantity());
            }
            foreach($i->getWithout() as $w){
                $wi = $em->getRepository('RestaurantBundle:Ingredient')->find($w->getId());
                $without = new Without();
                $without->setName($wi->getName());
                $without->setItem($item);
                $em->persist($without);
                
            }
        }
        $order->setTotal($total);
        $em->flush();
        
        return new JsonResponse('Su Orden ha sido Registrada con Exito');
        }  catch (\Exception $e){
            return new JsonResponse('Su Orden NO ha sido Registrada');
        }
        
    }
}
