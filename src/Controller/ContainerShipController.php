<?php

namespace App\Controller;

use App\Entity\Containership;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerShipController extends AbstractController
{
    /**
     * @Route("/containership", name="listContainersShip", methods={"GET"})
     * @return JsonResponse
     */
    public function listContainersShip(): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Containership::class)->findAll());
    }

    /**
     * @Route("/containership/{id}", name="getContainerShip", methods={"GET"}, requirements={"id"="\d+"})
     * @param int $id
     * @return JsonResponse
     */
    public function getContainerShip(int $id): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Containership::class)->find($id));
    }

    /**
     * @Route("/containership/new", name="newContainerShip", methods={"POST", "GET"})
     * @param Request $request
     * @return Response
     */
    public function newContainerShip(Request $request): Response
    {

        if ($request->request->has('name') && $request->request->has('captainName') && $request->request->has('containerLimit')) {

            $managerEntity = $this->getDoctrine()->getManager();
            $containerShip = new containerShip();
            $containerShip->setName($request->request->get('name'));
            $containerShip->setCaptainName($request->request->get('captainName'));
            $containerShip->setContainerLimit($request->request->get('containerLimit'));
            $managerEntity->persist($containerShip);
            $managerEntity->flush();
             return new Response('Le porte-conteneur ' .$containerShip->getName().' a été ajouté avec succès');
        } else{
            return $this->render('containership/containership.html.twig');
        }
    }
}
