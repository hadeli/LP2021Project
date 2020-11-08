<?php

namespace App\Controller;

use App\Entity\ContainerShip;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContainerShipController extends AbstractController
{
    /**
     * @Route("/containerShip", name="getAllContainerShip" , methods={"GET"})
     *
     */
    public function getAllContainerShip()
    {

        $manager = $this->getDoctrine()->getManager();
        $containerShipList = $manager->getRepository(ContainerShip::class)->findAll();
        return $this->json($containerShipList);
    }


    /**
     * @Route("/containerShip/{id}", name="getContainerShipById",methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function getContainerShipById(int $id)
    {

        return $this->json($this->getDoctrine()
            ->getRepository(ContainerShip::class)->find($id));

    }
}
