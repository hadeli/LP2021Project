<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerModel;
use App\Entity\Containership;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerController extends AbstractController
{
    /**
     * @Route("/container", name="listContainers",methods={"GET"})
     * @return JsonResponse
     */
    public function listContainers(): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Container::class)->findAll());
    }

    /**
     * @Route("/container/{id}", name="getContainer",methods={"GET"}, requirements={"id"="\d+"})
     * @param int $id
     * @return JsonResponse
     */
    public function getContainer(int $id): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Container::class)->find($id));
    }

    /**
     * @Route("/container/new", name="newContainer", methods={"POST", "GET"})
     * @param Request $request
     * @return Response
     */
    public function newContainer(Request $request): Response
    {

        $container = new Container();

        $form = $this->createFormBuilder($container)
            ->add('color', TextType::class)
            ->add('containership', EntityType::class, [
                'class' => Containership::class,
                'choice_label' => 'name'
            ])
            ->add('containerModel', EntityType::class, [
                'class' => ContainerModel::class,
                'choice_label' => 'name'
            ])
            ->add('submit', SubmitType::class, ['label' => 'Add'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $container = $form->getData();

            $nbContainer =  $this->getDoctrine()->getRepository(Container::class)->findBy(['containership' => $container->getContainership()]);
            $nbContainer  = count($nbContainer);

            $containerLimit = $container->getContainership()->getContainerLimit();

            if ($containerLimit > $nbContainer)
            {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($container);
                $entityManager->flush();

                return new Response("Ajout d'un ".$container->getContainerModel()->getName()." dans le ".$container->getContainership()->getName());

            } else{

                return new Response("Il y a déja le nombre maximale de conteneur dans le porte-conteneur " .$container->getContainership()->getName());
            }
        }

        return $this->render("container/container.html.twig", [
            "form" => $form->createView(),
        ]);
    }
}
