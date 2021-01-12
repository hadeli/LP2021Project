<?php

// src/Controller/ContainerController.php
namespace App\Controller;


use App\Entity\Containership;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
// ...

class ContainerShipController extends AbstractController
{
    //return container id
    public function GetContainerShip(int $id): JsonResponse
    {
        $containership = $this->getDoctrine()->getRepository(Containership::class)->find($id);
        return $this->json([$containership]);
    }

    //return all containers
    public function ListContainerShips(): JsonResponse
    {
        $containership = $this->getDoctrine()->getRepository(Containership::class)->findAll();
        return $this->json([$containership]);
    }
    public function CreateContainerShip(Request $request): Response
    {
        if ($request->query->has('name') && $request->query->has('captainName') && $request->query->has('containerLimit')) {
            echo 'GET';

            $manager = $this->getDoctrine()->getManager();
            $containership = new ContainerShip();
            $containership->setName($request->query->get('name'));
            $containership->setCaptainName($request->query->get('captainName'));
            $containership->setContainerLimit($request->query->get('containerLimit'));
            $manager->persist($containership);
            $manager->flush();

            return $this->json($containership);
        } elseif ($request->request->has('name') && $request->request->has('captainName') && $request->request->has('containerLimit')) {
            echo 'POST';
            //do something
            $manager = $this->getDoctrine()->getManager();
            $containership = new ContainerShip();
            $containership->setName($request->request->get('name'));
            $containership->setCaptainName($request->request->get('captainName'));
            $containership->setContainerLimit($request->request->get('containerLimit'));
            $manager->persist($containership);
            $manager->flush();

            return $this->json($containership);
        } else {
            return $this->render('ContainerShip/ContainerShip.html.twig');
            //return $this->json(['The Post or get does not have name, captainName and containerLimit' ]);
        }

    }
}
