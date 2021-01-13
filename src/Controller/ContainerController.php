<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\Containership;
use App\Entity\ContainerModel;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/container")
 */
class ContainerController extends AbstractController
{
    /**
     * @Route("/", name="get_all_containers", methods={"GET"})
     */
    public function getAllAction(): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Container::class)->findAll());
    }

    /**
     * @Route("/{id}", name="get_one_container",  methods={"GET"})
     */
    public function getOneAction(int $id): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Container::class)->find($id));
    }

    /**
     * @Route("/new", name="set_new_container",  methods={"GET|POST"})
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function createAction(Request $request, EntityManagerInterface  $manager)
    {
        $container = new Container();

        $form = $this->createFormBuilder($container)
            ->add('color', TextType::class)
            ->add('container_model', EntityType::class, [
                'class' => ContainerModel::class,
                'choice_label' => 'name'
            ])
            ->add('containership', EntityType::class, [
                'class' => ContainerShip::class,
                'choice_label' => 'name'
            ])
            ->add('button', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($container);
            $manager->flush();

            return $this->redirectToRoute('get_one_container', ['id' => $container->getId()]);
        }

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}