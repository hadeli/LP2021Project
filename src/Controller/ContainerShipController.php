<?php

// src/Controller/ContainerController.php
namespace App\Controller;


use App\Entity\Containership;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
// ...

class ContainerShipController extends AbstractController
{
    //return container id
    public function GetContainerShip(int $id): JsonResponse
    {
        $container = $this->getDoctrine()->getRepository(Containership::class)->find($id);
        return $this->json([$container]);
    }

    //return all containers
    public function ListContainerShips(): JsonResponse
    {
        $container = $this->getDoctrine()->getRepository(Containership::class)->findAll();
        return $this->json([$container]);
    }
}
