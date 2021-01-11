<?php

namespace App\Controller;

use App\Entity\Container;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/container")
 */
class ContainerController extends AbstractController
{
    /**
     * @Route("/", name="get_all_containers", methods={"GET"})
     */
    public function getAllAction(): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Container::class)->findAll());
    }

    /**
     * @Route("/{id}", name="get_one_container",  methods={"GET"})
     */
    public function getOneAction(int $id): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Container::class)->find($id));
    }
}