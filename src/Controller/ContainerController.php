<?php

namespace App\Controller;

use App\Entity\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ContainerController extends AbstractController
{
    /**
     * @Route("/container", name="container")
     */
    public function getContainerAction(): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $containerList = $manager->getRepository(Container::class)->findAll();
        return $this->json($containerList);
    }

    /**
     * @Route("/container/{id}", name="containerId")
     */
    public function getContainerIdAction(int $id): Response
    {
        return $this->json($this->generateOneContainer());
    }

    private function createFromRequest(Request $request):Container
    {
        return new Container($request->get('id'), $request->get('color'),
            $request->get('container_model_id'), $request->get('containership_id'));
    }

    private function generateOneContainer():Container
    {
        return new Container(1,'blue',1,1);
    }
}
