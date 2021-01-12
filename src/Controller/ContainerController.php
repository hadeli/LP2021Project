<?php

// src/Controller/ContainerController.php
namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerModel;
use App\Entity\Containership;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// ...

class ContainerController extends AbstractController
{
    //return container id
    public function GetContainer(int $id): JsonResponse
    {
        $container = $this->getDoctrine()->getRepository(Container::class)->find($id);
        return $this->json([$container]);
    }

    //return all containers
    public function ListContainers(): JsonResponse
    {
        $container = $this->getDoctrine()->getRepository(Container::class)->findAll();
        return $this->json([$container]);
    }

    public function CreateContainer(Request $request): Response
    {
        $Container = new Container();
        $form = $this->createFormBuilder($Container)
            ->add('color', TextType::class)
            ->add('containerModel', EntityType::class, [
                'class' => ContainerModel::class,
                'choice_label' => 'name'
            ])
            ->add('containership', EntityType::class, [
                'class' => Containership::class,
                'choice_label' => 'name'
            ])
            ->add('submit', SubmitType::class, ['label'=>'Create Container !'])
            ->getForm()
        ;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated

            $Container = $form->getData();

            // Partie métier



            //il faut récup le containership avec l'id
            //il faut récup le nombre de container que le containership trnasporte déja
            $selectedShipID = $Container->getContainership()->getId();
            $containerShipQuerry = $this->getDoctrine()->getRepository(Containership::class)->find($selectedShipID);

            $numberOfCarriedContainers = $this->getDoctrine()->getRepository(Container::class)->findBy(['containership' => $selectedShipID]);
            $numberOfCarriedContainers = count($numberOfCarriedContainers);

            $containerLimit = $containerShipQuerry->getContainerLimit();

            if ($containerLimit >= $numberOfCarriedContainers + 1) {
//               for example, if Task is a Doctrine entity, save it!
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($Container);
                $entityManager->flush();
                 //c'est pas très propre, je sais
//                echo gettype($containerLimit);
//                echo gettype($numberOfCarriedContainers);
//                dd($numberOfCarriedContainers);
                echo '<p>Container Ajouté</p> <br>';

                if($containerLimit - $numberOfCarriedContainers - 1 === 0) {
                    echo '<p>Container ajouté, Le containerShip n\'a plus de places de libre</p><br>';
                }else {
                    echo '<p>Container ajouté, Le containerShip a encore '. strval($containerLimit - $numberOfCarriedContainers - 1) . ' places de libre</p><br>';
                }

            } else {
                echo 'Le containership est plein, il ne peut pas transporter un container de plus !';
            }

            //je sais pas s'il faut le faire ça ....
            //return $this->redirectToRoute('task_success');
        }

        return $this->render('Container/Container.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
