<?php

namespace App\Controller;

use App\Entity\Container;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ContainerController extends AbstractController
{
    /**
     * @Route("/container", name="list_container")
     */
    public function showListContainer() : JsonResponse
    {
        $manager = $this->getDoctrine()->getManager();
        $list = $manager->getRepository(Container::class)->findAll();

        return $this->json($list);
    }
}