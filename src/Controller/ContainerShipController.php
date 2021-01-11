<?php

namespace App\Controller;

use App\Entity\Containership;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/containership")
 */
class ContainerShipController extends AbstractController
{
    /**
     * @Route("/", name="get_all_containerships", methods={"GET"})
     */
    public function getAllAction(): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Containership::class)->findAll());
    }

    /**
     * @Route("/{id}", name="get_one_containership",  methods={"GET"})
     */
    public function getOneAction(int $id): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Containership::class)->find($id));
    }
}