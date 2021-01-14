<?php

namespace App\Controller;

use App\Entity\Container;
use App\Form\ContainerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};


class ContainerController extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getAllContainer(): JsonResponse
    {
        return $this->json($this->manager->getRepository(Container::class)->findAll());
    }

    public function getOneContainer(int $id): JsonResponse
    {
        return $this->json($this->manager->getRepository(Container::class)->find($id));
    }

    public function newContainer(Request $request): Response
    {
        $container = new Container();

        // Création du formulaire
        $form = $this->createForm(ContainerType::class, $container);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $containerList = $this->manager->getRepository(Container::class)->findBy([
                'containership' => $form['containership']->getData()
            ]);

            $containershipLimit = $container->getContainership()->getContainerLimit();

            // Règle métier : Limite d'un porte conteneur
            if (count($containerList) >= $containershipLimit) {
                $this->addFlash('error', 'Ce porte-conteneurs ne peut pas excéder ' . $containershipLimit . ' conteneur(s) !');
            } else {
                // On insère les données dans la base de données
                $this->manager->persist($container);
                $this->manager->flush();

                $this->addFlash('success', 'Le conteneur a été crée à l\'id : ' . $container->getId());
            }
        }

        return $this->render('container.html.twig', [
            'formContainer' => $form->createView()
        ]);
    }
}
