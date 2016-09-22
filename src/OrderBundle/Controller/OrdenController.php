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
use FOS\RestBundle\Controller\Annotations\Post;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use OrderBundle\Entity\Orden;
use OrderBundle\Entity\Item;
use OrderBundle\Entity\Without;
use OrderBundle\Entity\AditionalItem;
use OrderBundle\Entity\ComboOrder;

class OrdenController extends FOSRestController implements 
    ClassResourceInterface 
{
   /**
     * GET Route annotation.
     * @Post("/api/createorder")
     */
    public function getPlatesAction(
            Request $request
            ) {
        
        
        $user = $this->get('security.context')->getToken()->getUser();
        $client = $user->getClient();
        $cart=$client->getCart();
        
        $em = $this->getDoctrine()->getManager();
        
        $order = new Orden();
        $order->setClient($client);
        $order->setDate(new \DateTime());
        $order->setCode('1234567');
        $order->setDescription("hola que hace");
        $order->setRestaurantId($cart->getIdRestaurant());
        $order->setSubTotal(0);
        $order->setTotal($cart->getTotal());
        $em->persist($order);
        $restaurant = $em->getRepository('RestaurantBundle:Restaurant')->find($cart->getIdRestaurant());
        
        $total = 0;
        foreach($cart->getPlatesCart() as $i){
            $plate = $em->getRepository('RestaurantBundle:Plate')->find($i->getIdPlate());
            $item = new Item();
            $item->setName($plate->getName());
            $item->setPrice($plate->getPrice());
            $item->setQuantity($i->getQuantity());
            $item->setOrder($order);
            $em->persist($item);
            $total +=($plate->getPrice()*$i->getQuantity());
            
            foreach($i->getAditionalItemsCart() as $add){
                $adit = $em->getRepository('RestaurantBundle:Aditional')->find($add->getIdAditionalItem());
                $aditional = new AditionalItem();
                $aditional->setItem($item);
                $aditional->setName($adit->getName());
                $aditional->setPrice($adit->getPrice());
                $aditional->setQuiantity($add->getQuantity());
                $em->persist($aditional);
                $total +=($adit->getPrice()*$add->getQuantity());
            }
            foreach($i->getWithoutsCart() as $w){
                $wi = $em->getRepository('RestaurantBundle:Ingredient')->find($w->getIdWithout());
                $without = new Without();
                $without->setName($wi->getName());
                $without->setItem($item);
                $em->persist($without);
                
            }
        }
        
        foreach($cart->getCombosCart() as $cc){
            $co = $em->getRepository('RestaurantBundle:Combo')->find($cc->getIdCombo());
            $comboOrder = new ComboOrder();
            $comboOrder->setDescription($co->getName());
            $comboOrder->setOrder($order);
            $comboOrder->setPrice($co->getPrice());
            $comboOrder->setQuantity($cc->getQuantity());
            $em->persist($comboOrder);
        }
        $em->flush();
        
        return new JsonResponse('Su Orden ha sido Registrada con Exito Puede Retirarla en el Restaurant '.$restaurant->getName().
                ' Con el Número de Orden '.$order->getCode());
        
        
    }
}
