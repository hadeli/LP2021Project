<?php

namespace App\Controller;

use App\Entity\Containership;
use App\Form\ContainershipType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};


class ContainershipController extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getAllContainership(): JsonResponse
    {
        return $this->json($this->manager->getRepository(Containership::class)->findAll());
    }

    public function getOneContainership(int $id): JsonResponse
    {
        return $this->json($this->manager->getRepository(Containership::class)->find($id));
    }

    public function newContainership(Request $request): Response
    {
        $containership = new Containership();

        // Création du formulaire
        $form = $this->createForm(ContainershipType::class, $containership);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On insère les données dans la base de données
            $this->manager->persist($containership);
            $this->manager->flush();

            $this->addFlash('success', 'Le porte-conteneurs "' . $containership->getName() . '" a été crée !');
        }

        return $this->render('containership.html.twig', [
            'formContainership' => $form->createView()
        ]);
    }
}
