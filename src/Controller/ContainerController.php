<?php

namespace App\Controller;

use App\Repository\ContainerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ContainerController extends AbstractController
{
    /**
     * @Route("/container", name="container", methods={"GET"})
     */
    public function getAll(ContainerRepository $containerRepository): JsonResponse
    {
        return $this->json($containerRepository->findAll());
    }
}
