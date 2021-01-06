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
     * @Route("/container", name="getAllContainer" , methods={"GET"})
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

    /**
     * @Route("/container/new", name="postContainer",methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function postContainer(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        $ship = $manager->getRepository(ContainerShip::class)
            ->findOneBy(['id' => $_POST['containership_id']]);

        $containers = $manager->getRepository(Container::class)
            ->findBy(['containership_id' => $_POST['containership_id']]);

        if((sizeof($containers) + 1) <= $ship->getContainerLimit()) {
            $container = $this->createFromRequest($request);
            $manager->persist($container);
            $manager->flush();
        } else {
            $container = [
                'erreur' => 'Le bateau que vous avez choisis est complet !'
            ];
        }

        return $this->json($container);
    }

    private function createFromRequest(Request $request): Container
    {
        return new Container($request->get('color'),
            $request->get('container_model_id'),
            $request->get('containership_id')
        );
    }
}
