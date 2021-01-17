<?php


namespace App\Controller;



use App\Entity\Container;
use App\Entity\ContainerShip;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainershipController extends AbstractController
{
    /**
     * @return Response
     */
    public function getAllContainership()
    {
        $manager = $this->getDoctrine()->getManager();
        $containerShipList = $manager->getRepository(ContainerShip::class)->findAll();
        return $this->json($containerShipList);
    }


    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getContainershipById(int $id): JsonResponse
    {
        $containership = $this->getDoctrine()->getRepository(Containership::class)->find($id);
        return $this->json([$containership]);

    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createContainership(Request $request)
    {

        $manager = $this->getDoctrine()->getManager();
        $containership = new Containership();
        $containership->setName($request->get('name'));
        $containership->setCaptainName($request->get('captain_name'));
        $containership->setContainerLimit($request->get('container_limit'));
        $manager->persist($containership);
        $manager->flush();

        return $this->json($containership);
    }



}