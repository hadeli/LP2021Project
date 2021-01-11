<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerModel;
use App\Entity\Containership;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerController extends AbstractController
{
    /**
     * @Route("/container", name="listContainers",methods={"GET"})
     * @return JsonResponse
     */
    public function listContainers(): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Container::class)->findAll());
    }

    /**
     * @Route("/container/{id}", name="getContainer",methods={"GET"}, requirements={"id"="\d+"})
     * @param int $id
     * @return JsonResponse
     */
    public function getContainer(int $id): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Container::class)->find($id));
    }
}
