<?php

namespace App\Controller;

use App\Entity\Containership;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ContainerShipController extends AbstractController
{
    /**
     * @Route("/containership", name="listContainersShip", methods={"GET"})
     * @return JsonResponse
     */
    public function listContainersShip(): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Containership::class)->findAll());
    }

    /**
     * @Route("/containership/{id}", name="getContainerShip", methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function getContainerShip(int $id): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Containership::class)->find($id));
    }
}
