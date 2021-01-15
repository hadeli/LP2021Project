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

    public function index(): Response
    {
        return $this->json($this->getDoctrine()->getRepository(Containership::class)->findAll());
    }


    public function show($id): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Containership::class)->find($id));
    }


    public function createContainership(Request $request)
    {
        $containership = new Containership();
        $containershipForm = $this->createForm(ContainershipFormType::class, $containership);
        $containershipForm->handleRequest($request);

        if ($containershipForm->isSubmitted() && $containershipForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($containership);
            $em->flush();

            return $this->redirect('/containership');
        }

        return $this->render('container_product/new.html.twig', [
            'form' => $containershipForm->createView(),
        ]);
    }
}
