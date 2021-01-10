<?php

// src/Controller/ContainerController.php
namespace App\Controller;


use App\Entity\Containership;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
// ...

class ContainerShipController extends AbstractController
{
    //return container id
    public function GetContainerShip(int $id): JsonResponse
    {
        $containership = $this->getDoctrine()->getRepository(Containership::class)->find($id);
        return $this->json([$containership]);
    }

    //return all containers
    public function ListContainerShips(): JsonResponse
    {
        $containership = $this->getDoctrine()->getRepository(Containership::class)->findAll();
        return $this->json([$containership]);
    }
    public function CreateContainerShip(Request $request): JsonResponse
    {
        $manager = $this->getDoctrine()->getManager();
        $containership = new ContainerShip();
        $containership->setName($request->query->get('name'));
        $containership->setCaptainName($request->query->get('captainName'));
        $containership->setContainerLimit($request->query->get('containerLimit'));
        $manager->persist($containership);
        $manager->flush();

        return $this->json($containership);
    }
}
