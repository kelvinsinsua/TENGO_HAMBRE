<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ParametersBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ParametersController extends FOSRestController implements
ClassResourceInterface {

    /**
     * GET Route annotation.
     * @Get("/api/findmenucategories")
     */
    public function getPlateAction(
    Request $request
    ) {

        $em = $this->getDoctrine()->getManager();
        $menuCategories = $em->getRepository('ParametersBundle:MenuCategory')->findAll();
        $r = $this->encoderMenuCategory($menuCategories);
        return new JsonResponse($r);
    }

    public function encoderMenuCategory($entity) {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $serializer = new Serializer(array($normalizer), array($encoder));


        $normalizer->setIgnoredAttributes(array(
            'menus'
        ));
        $jsonEntity = $serializer->serialize($entity, 'json');
        return $jsonEntity;
    }

}
