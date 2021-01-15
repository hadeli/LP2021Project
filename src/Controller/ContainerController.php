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
    /**
     * @Route("/container", name="container", methods={"GET"})
     */
    public function index(): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Container::class)->findAll());
    }

    /**
     * @Route("/container/{id}", methods={"GET"})
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Container::class)->find($id));
    }

    /**
     * @Route("/container_new")
     * @param Request $request
     * @return Response
     */
    public function createContainer(Request $request)
    {
        $container = new Container();
        $containerForm = $this->createForm(ContainerFormType::class, $container);
        $containerForm->handleRequest($request);

        if ($containerForm->isSubmitted() && $containerForm->isValid()) {

            if ($this->getDoctrine()->getRepository(Containership::class)->isFull($container->getContainership()->getId()))
            {
                echo 'yey';
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($container);
            $em->flush();
        }

        return $this->render('container/new.html.twig', [
            'form' => $containerForm->createView(),
        ]);
    }
}
