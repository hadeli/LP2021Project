<?php

namespace App\Controller;

use App\Entity\Containership;
use App\Form\ContainershipFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainershipController extends AbstractController
{
    /**
     * @Route("/containership", name="containership")
     */
    public function index(): Response
    {
        return $this->json($this->getDoctrine()->getRepository(Containership::class)->findAll());
    }

    /**
     * @Route("/containership/{id}", methods={"GET"})
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Containership::class)->find($id));
    }

    /**
     * @Route("/containership_new")
     * @param Request $request
     * @return Response
     */
    public function createContainership(Request $request)
    {
        $containership = new Containership();
        $containershipForm = $this->createForm(ContainershipFormType::class, $containership);
        $containershipForm->handleRequest($request);

        if ($containershipForm->isSubmitted() && $containershipForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($containership);
            $em->flush();
        }

        return $this->render('container_product/new.html.twig', [
            'form' => $containershipForm->createView(),
        ]);
    }
}
