<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Container as ContainerEntity;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ContainerModel as ContainerModelEntity;
use App\Entity\Containership as ContainerShipEntity;

class Container extends AbstractController {

    /**
     * @Route("/container", name="container_list", methods={"GET"})
     * @return Response
     */
    public function list() : Response {
        $containers = $this->getDoctrine()->getRepository(ContainerEntity::class)->findAll();
        dd ($containers);
    }

    /**
     * @Route("/container/{id}", name="container_details", methods={"GET"})
     * @return Response
     */
    public function details($id) : Response {
        $container = $this->getDoctrine()->getRepository(ContainerEntity::class)->find($id);
        dd($container);
    }

    /**
     * @Route("/container/new", name="container_new", methods={"PUT"})
     * @param Request $request
     * @return Response
     */
    public function create(Request $request) : Response {

        $paramsRequire = ['Color', 'ContainerModel', 'ContainerShip'];
        foreach ($request->query->keys() as $k) if (!in_array($k, $paramsRequire)) return new Response("Champ(s) manquant(s)");

        $containerModel = $this->getDoctrine()->getRepository(ContainerModelEntity::class)->find($request->query->getInt("ContainerModel"));
        if (!$containerModel) return new Response("ContainerModel introuvable");

        $containerShip = $this->getDoctrine()->getRepository(ContainerShipEntity::class)->find($request->query->getInt("ContainerShip"));
        if (!$containerShip) return new Response("ConatinerShip introuvable");

        $entityManager = $this->getDoctrine()->getManager();

        $container = new ContainerEntity();
        $container->setColor($request->query->get('Color'));
        $container->setContainerModel($containerModel);
        $container->setContainership($containerShip);

        $entityManager->persist($container);
        $entityManager->flush();

        return new Response("Ok");
    }
}