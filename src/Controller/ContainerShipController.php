<?php

namespace App\Controller;

use App\Entity\ContainerShip;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ContainerShipController extends AbstractController
{

    public function getAllContainerShip(): JsonResponse
    {
        $container_ship = $this->getDoctrine()->getRepository(ContainerShip::class)->findAll();
        return $this->json([$container_ship]);
    }

    public function getContainerShip($id): JsonResponse
    {
        $container_ship = $this->getDoctrine()->getRepository(ContainerShip::class)->find($id);
        return $this->json([$container_ship]);
    }

    public function newContainerShip(Request $request, EntityManagerInterface $manager)
    {
        $container_ship = new ContainerShip();
        $form = $this->createFormBuilder($container_ship)
            ->add('name')
            ->add('captainName')
            ->add('containerLimit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $this->addFlash("success", "Le porte-conteneurs " . $container_ship->getName() . " à bien ajouté.");
            $manager->persist($container_ship);
            $manager->flush();
        }

        return $this->render('ContainerShip/containership.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}