<?php

namespace App\Controller;

use App\Entity\Containership;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\{IntegerType, SubmitType, TextType};
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

        $form = $this->createFormBuilder($containership)
            ->add('name', TextType::class, [
                'label' => 'Nom du porte-conteneurs : ',
                'attr' => [
                    'placeholder' => 'Nom du porte-conteneurs'
                ]
            ])
            ->add('captainName', TextType::class, [
                'label' => 'Nom du capitaine : ',
                'attr' => [
                    'placeholder' => 'Nom du capitaine'
                ]
            ])
            ->add('containerLimit', IntegerType::class, [
                'label' => 'Limite de conteneur(s) : ',
                'attr' => [
                    'placeholder' => 'Limite de conteneur(s)'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($containership);
            $this->manager->flush();

            $message = 'Le porte-conteneurs "' . $containership->getName() . '" a été crée !';

            return $this->render('containership.html.twig', [
                'formContainership' => $form->createView(),
                'msg' => $message
            ]);
        }

        return $this->render('containership.html.twig', [
            'formContainership' => $form->createView()
        ]);
    }
}
