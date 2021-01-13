<?php

namespace App\Controller;

use App\Entity\Container;

use App\Entity\ContainerShip;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param $id
     * @return Response
     */
    public function specificContainer($id): Response
    {
        $container = new Container();
        $method = Request::createFromGlobals()->getMethod();

        if ($method === 'POST') {
            if ($id === 'new') {
                $manager = $this->getDoctrine()->getManager();
                $ship = $manager->getRepository(ContainerShip::class)
                    ->findOneBy(['id' => $_POST['containership_id']]);

                $containers = $manager->getRepository(Container::class)
                    ->findBy(['containership_id' => $_POST['containership_id']]);

                if (isset($ship)) {
                    if ((count($containers) + 1) <= $ship->getContainerLimit()) {
                        if (isset($_POST['color'])) {
                            $container->setColor($_POST['color']);
                        }

                        if (isset($_POST['container_model_id'])) {
                            $container->setContainerModelId($_POST['container_model_id']);
                        }

                        if (isset($_POST['containership_id'])) {
                            $container->setContainershipId($_POST['containership_id']);
                        }

                        $manager->persist($container);
                        $manager->flush();

                    } else {
                        $container = 'On ne peut plus ajouter de container.';
                    }
                }
            }
        } else {
            $container = $this->getDoctrine()->getRepository(Container::class)->find($id);

        }
        return $this->json($container);
    }
}