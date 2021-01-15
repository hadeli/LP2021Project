<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\Containership;
use App\Form\ContainerFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerController extends AbstractController
{

    public function index(): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Container::class)->findAll());
    }


    public function show($id): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Container::class)->find($id));
    }


    public function createContainer(Request $request)
    {
        $container = new Container();
        $containerForm = $this->createForm(ContainerFormType::class, $container);
        $containerForm->handleRequest($request);

        if ($containerForm->isSubmitted() && $containerForm->isValid()) {

            // Needs it s own validator.
            $containershipId = $container->getContainership()->getId();
            $numberOfCarriedContainers = $this->getDoctrine()->getRepository(Container::class)->findBy(['containership' => $containershipId]);
            $numberOfCarriedContainers = count($numberOfCarriedContainers);

            $containerShipQuerry = $this->getDoctrine()->getRepository(Containership::class)->find($containershipId);
            $containerLimit = $containerShipQuerry->getContainerLimit();

            $remainingspace = $containerLimit - $numberOfCarriedContainers - 1;

            if ($remainingspace <= 0)
            {
                return $this->redirect('/container/new');
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($container);
            $em->flush();
            return $this->redirect('/container');
        }

        return $this->render('container/new.html.twig', [
            'form' => $containerForm->createView(),
        ]);
    }
}
