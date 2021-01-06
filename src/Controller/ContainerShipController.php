<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerShip;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerShipController extends AbstractController
{
    /**
     * @Route("/containership", name="getAllContainerShip" , methods={"GET"})
     */
    public function getAllContainerShip()
    {
        $manager = $this->getDoctrine()->getManager();
        $containerShipList = $manager->getRepository(ContainerShip::class)->findAll();
        return $this->json($containerShipList);
    }


    /**
     * @Route("/containership/{id}", name="getContainerShipById",methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function getContainerShipById(int $id)
    {
        return $this->json($this->getDoctrine()
            ->getRepository(ContainerShip::class)->find($id));

    }

    /**
     * @Route("/containership/new", name="postContainership",methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function postContainership(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $containership = $this->createFromRequest($request);
        $manager->persist($containership);
        $manager->flush();

        return $this->json($containership);
    }

    private function createFromRequest(Request $request): ContainerShip
    {
        return new ContainerShip($request->get('name'),
            $request->get('captain_name'),
            $request->get('container_limit')
        );
    }
}
