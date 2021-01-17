<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerShip;
use http\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ContainerController extends AbstractController
{

    /**
     * @return Response
     */
    public function getAllContainer(): Response {
        $manager = $this->getDoctrine()->getManager();
        $containerList = $manager->getRepository(Container::class)->findAll();
        return $this->json($containerList);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getContainerById(int $id): JsonResponse
    {
        $container = $this->getDoctrine()->getRepository(Container::class)->find($id);
        return $this->json([$container]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createContainer(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        

        $ship = $manager->getRepository(Containership::class)->findOneBy(['id' => $_POST['containership']]);

        $containers = $manager->getRepository(Container::class)->findBy(['containership' => $_POST['containerModel']]);


        if((sizeof($containers) + 1) <= $ship->getContainerLimit()) {
            $container = new Container();
            $container->setColor($request->get('color'));
            $container->setContainerModel($request->get('container_model_id'));
            $container->setContainership($request->get('containership_id'));
            $manager->persist($container);
            $manager->flush();

            $manager->persist($container);
            $manager->flush();
        } else {
            $container = [
                'error' => 'The ship is full !'
            ];
        }



        return $this->json($container);
    }

}
