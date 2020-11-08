<?php

namespace App\Controller;

use App\Entity\Container;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContainerController extends AbstractController
{
    /**
     * @Route("/container", name="getAllContainer" , methods={"GET"})
     *
     */
    public function getAllContainer()
    {

        $manager = $this->getDoctrine()->getManager();
        $containerList = $manager->getRepository(Container::class)->findAll();
        return $this->json($containerList);
    }


    /**
     * @Route("/container/{id}", name="getContainerById",methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function getContainerById(int $id)
    {

        return $this->json($this->getDoctrine()
            ->getRepository(Container::class)->find($id));

    }
}
