<?php

namespace VnzlaStatesBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class StateController extends FOSRestController implements ClassResourceInterface {

    
    /**
     * GET Route annotation.
     * @Get("/api/findstates")
     */
    public function getStatesAction(Request $request) {
        $consultType = $request->get('consultType');
        $states = $this->StateRepository($consultType)->searchStates();
            
        
        $r = $this->encoder($states);
        
        return new JsonResponse($r);
    }
    /**
     * GET Route annotation.
     * @Get("/api/findcities")
     */
    public function getCitiesAction(Request $request) {
        try{
        $id = $request->get('id');
        if($id==null){
            throw new BadRequestHttpException(); 
        }
        $consultType = $request->get('consultType');
        $cities = $this->CityRepository($consultType)->searchCities($id);       
        $r = $this->encoderCities($cities);
        
        return new JsonResponse($r);
        }catch(BadRequestHttpException $ex){
            throw new BadRequestHttpException('id = null');
        }
        
        catch(\Exception $e){
           throw new HttpException(500,'error='.$e->getMessage()."\n".'line= '.$e->getLine().'trace= '.$e->getTraceAsString()); 
        }
    }
    /**
     * GET Route annotation.
     * @Get("/api/findmunicipalties")
     */
    public function getMunicipaltiesAction(Request $request) {
        $id = $request->get('id');
        if($id==null||$id==''){
           return new JsonResponse('El id del estado es null o vacío'); 
        }
        $consultType = $request->get('consultType');
        $municipalties = $this->MunicipaltyRepository($consultType)->searchMunicipalties($id);       
        $r = $this->encoderMunicipalty($municipalties);
        
        return new JsonResponse($r);
    }
    /**
     * GET Route annotation.
     * @Get("/api/findparishes")
     */
    public function getParishesAction(Request $request) {
        $id = $request->get('id');
        if($id==null||$id==''){
           return new JsonResponse('El id del estado es null o vacío'); 
        }
        $consultType = $request->get('consultType');
        $parishes = $this->ParishRepository($consultType)->searchParishes($id);       
        $r = $this->encoderParishes($parishes);
        
        return new JsonResponse($r);
    }
   public function StateRepository($consultType){
       if($consultType=="elastica"){
        $repositoryManager = $this->container->get('fos_elastica.manager');
        $repository = $repositoryManager->getRepository('VnzlaStatesBundle:State');
       }else{         

        $repository = $this->getDoctrine()->getRepository('VnzlaStatesBundle:State');


       }
        return $repository;
    }
   public function CityRepository($consultType){
        if($consultType=="elastica"){
        $repositoryManager = $this->container->get('fos_elastica.manager');
        $repository = $repositoryManager->getRepository('VnzlaStatesBundle:City');
       }else{         

        $repository = $this->getDoctrine()->getRepository('VnzlaStatesBundle:City');


       }
        return $repository;
    }
   public function ParishRepository($consultType){
        if($consultType=="elastica"){
        $repositoryManager = $this->container->get('fos_elastica.manager');
        $repository = $repositoryManager->getRepository('VnzlaStatesBundle:Parish');
       }else{         

        $repository = $this->getDoctrine()->getRepository('VnzlaStatesBundle:Parish');


       }
       return $repository;
    }
   public function MunicipaltyRepository($consultType){
        if($consultType=="elastica"){
        $repositoryManager = $this->container->get('fos_elastica.manager');
        $repository = $repositoryManager->getRepository('VnzlaStatesBundle:Municipalty');
       }else{         

        $repository = $this->getDoctrine()->getRepository('VnzlaStatesBundle:Municipalty');


       }
       return $repository;
    }
    public function encoder($entity) {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $serializer = new Serializer(array($normalizer), array($encoder));
        $normalizer->setIgnoredAttributes(array('municipalties','cities','country'));
        $jsonEntity = $serializer->serialize($entity, 'json');

        return $jsonEntity;
    }
    public function encoderCities($entity) {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $serializer = new Serializer(array($normalizer), array($encoder));
        $normalizer->setIgnoredAttributes(array('state'));
        $jsonEntity = $serializer->serialize($entity, 'json');

        return $jsonEntity;
    }
    public function encoderMunicipalty($entity) {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $serializer = new Serializer(array($normalizer), array($encoder));
        $normalizer->setIgnoredAttributes(array('state','parishes'));
        $jsonEntity = $serializer->serialize($entity, 'json');

        return $jsonEntity;
    }
    public function encoderParishes($entity) {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();
        $serializer = new Serializer(array($normalizer), array($encoder));
        $normalizer->setIgnoredAttributes(array('municipalty'));
        $jsonEntity = $serializer->serialize($entity, 'json');

        return $jsonEntity;
    }
   

}
