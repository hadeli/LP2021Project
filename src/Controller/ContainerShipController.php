<?php


namespace App\Controller;

use App\Entity\Containership;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContainerShipController
 * @package App\Controller
 *
 */
class ContainerShipController extends  AbstractController
{
    /**
     * @Route("/containerShip",name="getAllContainerShip",methods={"GET"})
     */
    public function getAllContainerShip(){
        return $this->json($this->getDoctrine()->getRepository(Containership::class)->findAll());
    }


    /**
     * @Route("/containerShip/{id}",name="getContainerShipById",methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function getContainerShipById(int $id){
        return $this->json($this->getDoctrine()->getRepository(Containership::class)->find($id));
    }

    /**
     * @Route("/containerShip/new",name="addContainership",methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function addContainership(Request $request){

        $entityManager = $this->getDoctrine()->getManager();

        $ship = new Containership();
        $ship->setName($request->query->get('name'));
        $ship->setCaptainName($request->query->get('captain'));
        $ship->setContainerLimit($request->query->get('limit'));

        $entityManager->persist($ship);
        $entityManager->flush();

        return new Response('bateau ajouté a l\'id '.$ship->getId());
    }




}