<?php

// src/Controller/ContainerController.php
namespace App\Controller;

use App\Entity\Container;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
// ...

class ContainerController extends AbstractController
{

    public function GetContainer(int $id): JsonResponse
    {
        $container = $this->getDoctrine()->getRepository(Container::class)->find($id);
        return $this->json([$container]);
    }

    public function ListContainers(): JsonResponse
    {
        $container = $this->getDoctrine()->getRepository(Container::class)->findAll();
        return $this->json([$container]);
    }
}
