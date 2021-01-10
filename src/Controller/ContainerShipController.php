<?php

namespace App\Controller;

use App\Entity\ContainerShip;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerShipController extends AbstractController
{
    /**
     * @Route("/containership", name="list_container_ship")
     */
    public function showListContainerShip() : Response
    {
        return $this->json($this->getDoctrine()->getRepository(ContainerShip::class)->findAll());
    }

    /**
     * @Route("/containership/{id}", name="container_ship")
     */
    public function showSpecificContainerShip($id): Response
    {
        return $this->json($this->getDoctrine()->getRepository(ContainerShip::class)->find($id));
    }
}