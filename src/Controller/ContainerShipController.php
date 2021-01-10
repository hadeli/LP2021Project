<?php

namespace App\Controller;

use App\Entity\ContainerShip;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ContainerShipController extends AbstractController
{
    /**
     * @Route("/containership", name="list_container_ship")
     */
    public function showListContainerShip() : JsonResponse
    {
        $manager = $this->getDoctrine()->getManager();
        $list = $manager->getRepository(ContainerShip::class)->findAll();

        return $this->json($list);
    }
}