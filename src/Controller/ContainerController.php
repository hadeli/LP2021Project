<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerShip;
use App\Entity\ContainerModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContainerController extends AbstractController
{
    public function getAllContainer(): JsonResponse
    {
        $container = $this->getDoctrine()->getRepository(Container::class)->findAll();
        return $this->json([$container]);
    }

    public function getContainer($id): JsonResponse
    {
        $container = $this->getDoctrine()->getRepository(Container::class)->find($id);
        return $this->json([$container]);
    }

    public function newContainer(Request $request, EntityManagerInterface $manager)
    {
        $container = new Container();

        $form = $this->createFormBuilder($container)
            ->add("color")
            ->add("containerModel", EntityType::class, [
                'class' => ContainerModel::class,
                'choice_label' => 'name'
            ])
            ->add("containerShip", EntityType::class, [
                'class' => ContainerShip::class,
                'choice_label' => 'name'
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            /**
             * Limite d'un porte conteneur
             */
            $containerLimit = $container->getContainerShip()->getContainerLimit();

            $getContainer = $this->getDoctrine()->getRepository(Container::class)->findBy([
                'containerShip' => $container->getContainerShip()
            ]);

            if (count($getContainer) >= $containerLimit) {
                $this->addFlash("error", "Ce porte-conteneur est limité à " . $containerLimit . " conteneur(s) !");
            } else {
                $manager->persist($container);
                $manager->flush();
                return $this->redirectToRoute("container");
            }
        }

        return $this->render("container/new.html.twig", [
            "form" => $form->createView(),
        ]);
    }
}