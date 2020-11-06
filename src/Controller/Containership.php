<?php

namespace App\Controller;

use App\Entity\Containership as ContainershipEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class Containership extends AbstractController {

    /**
     * @Route("/containership", name="containership_list", methods={"GET"})
     * @return Response
     */
    public function list() : Response {
        $containers = $this->getDoctrine()->getRepository(ContainershipEntity::class)->findAll();
        dd ($containers);
    }

    /**
     * @Route("/containership/{id}", name="containership_list_details", methods={"GET"})
     * @return Response
     */
    public function details($id) : Response {
        $container = $this->getDoctrine()->getRepository(ContainershipEntity::class)->find($id);
        dd($container);
    }

    /**
     * @Route("/containership/new", name="containership_new", methods={"PUT"})
     * @param Request $request
     * @return Response
     */
    public function create(Request $request) : Response {

        $paramsRequire = ['CaptainName', 'ContainerLimit', 'Name'];
        foreach ($request->query->keys() as $k) if (!in_array($k, $paramsRequire)) return new Response("Champ(s) manquant(s)");

        $entityManager = $this->getDoctrine()->getManager();

        $containerShip = new ContainershipEntity();
        $containerShip->setCaptainName($request->query->get("CaptainName"));
        $containerShip->setContainerLimit($request->query->getInt("ContainerLimit"));
        $containerShip->setName($request->query->get("Name"));

        $entityManager->persist($containerShip);
        $entityManager->flush();

        return new Response("ok");
    }

}