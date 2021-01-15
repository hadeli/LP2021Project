<?php

namespace App\Controller;

use App\Entity\Container;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerController extends AbstractController
{


    /**
     * @Route("/container", name="getAllContainer" , methods={"GET"})
     */
    public function getAllContainer() {
        $manager = $this->getDoctrine()->getManager();
        $containerList = $manager->getRepository(Container::class)->findAll();
        return $this->json($containerList);
    }
}
