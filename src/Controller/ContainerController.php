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
        $container = new Containership();
        $container->setName($request->get('name'));
        $container->setCaptainName($request->get('captain_name'));
        $container->setContainerLimit($request->get('container_limit'));
        $manager->persist($container);
        $manager->flush();

        return $this->json($container);
    }

}
