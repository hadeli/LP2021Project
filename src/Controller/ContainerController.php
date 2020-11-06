<?php

namespace App\Controller;

use App\Repository\ContainerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/container")
 */
class ContainerController extends AbstractController
{
    /**
     * @Route("/", name="getContainers", methods={"GET"})
     * @param ContainerRepository $containerRepository
     * @return JsonResponse
     */
    public function getAll(ContainerRepository $containerRepository): JsonResponse
    {
        return $this->json($containerRepository->findAll());
    }

    /**
     * @Route("/{id}", name="getContainer",  methods={"GET"})
     * @param int $id
     * @param ContainerRepository $containerRepository
     * @return JsonResponse
     */
    public function getById(int $id, ContainerRepository $containerRepository): JsonResponse
    {
        return $this->json($containerRepository->findBy(['id' => $id]));
    }
}
