<?php

namespace App\Controller;

use App\Entity\{Container, ContainerModel, Containership};
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\{SubmitType, TextType};
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

        $form = $this->createFormBuilder($container)
            ->add('color', TextType::class, [
                'label' => 'Couleur du conteneur : ',
                'attr' => [
                    'placeholder' => 'Couleur du conteneur'
                ]
            ])
            ->add('containerModel', EntityType::class, [
                'class' => ContainerModel::class,
                'choice_label' => 'name',
                'label' => 'Modèle du conteneur : '
            ])
            ->add('containership', EntityType::class, [
                'class' => Containership::class,
                'choice_label' => 'name',
                'label' => 'Porte-conteneur : '
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $containerList = $this->manager->getRepository(Container::class)->findBy([
                'containership' => $form['containership']->getData()
            ]);

            $containershipLimit = $container->getContainership()->getContainerLimit();

            if (count($containerList) >= $containershipLimit) {
                $this->addFlash('error', 'Ce porte-conteneurs ne peut pas excéder ' . $containershipLimit . ' conteneur(s) !');
            } else {
                $this->manager->persist($container);
                $this->manager->flush();

                $message = 'Le conteneur a été crée à l\'id : ' . $container->getId();

                return $this->render('container.html.twig', [
                    'formContainer' => $form->createView(),
                    'msg' => $message
                ]);
            }
        }

        return $this->render('container.html.twig', [
            'formContainer' => $form->createView()
        ]);
    }
}
