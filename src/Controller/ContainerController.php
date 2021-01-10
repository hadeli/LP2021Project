<?php

namespace App\Controller;

use App\Entity\Container;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerController extends AbstractController
{
    /**
     * @Route("/container", name="list_container")
     */
    public function showListContainer(): Response
    {
        return $this->json($this->getDoctrine()->getRepository(Container::class)->findAll());
    }

    /**
     * @Route("/container/{id}", name="container")
     */
    public function showSpecificContainer($id): Response
    {
        return $this->json($this->getDoctrine()->getRepository(Container::class)->find($id));
    }
}