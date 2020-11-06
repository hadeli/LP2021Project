<?php

namespace App\Controller;

use App\Repository\ContainershipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/containership")
 */
class ContainershipController extends AbstractController
{
    /**
     * @Route("/", name="getContainerships", methods={"GET"})
     * @param ContainershipRepository $containershipRepository
     * @return JsonResponse
     */
    public function getAll(ContainershipRepository $containershipRepository): JsonResponse
    {
        return $this->json($containershipRepository->findAll());
    }

    /**
     * @Route("/{id}", name="getContainership",  methods={"GET"})
     * @param int $id
     * @param ContainershipRepository $containershipRepository
     * @return JsonResponse
     */
    public function getById(int $id, ContainershipRepository $containershipRepository): JsonResponse
    {
        return $this->json($containershipRepository->findBy(['id' => $id]));
    }
}
