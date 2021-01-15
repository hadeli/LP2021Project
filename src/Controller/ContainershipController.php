<?php

namespace App\Controller;

use App\Entity\Containership;
use App\Form\ContainershipFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainershipController extends AbstractController
{
    private $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/containership", name="containershipList" , methods={"GET"})
     */
    public function containershipList()
    {
        return $this->json($this->getDoctrine()->getRepository(Containership::class)->findAll());
    }

    /**
     * @Route("/containership/{id}", name="containershipById" , methods={"GET"})
     * @param $id
     * @return JsonResponse
     */
    public function containershipById(int $id)
    {
        return $this->json($this->getDoctrine()->getRepository(Containership::class)->find($id));
    }

    /**
     * @Route("/containerships/new", name="containershipAdd", methods={"POST"})
     * @param $request
     * @return Response
     */
    public function containershipAdd(Request $request): Response
    {
        $containership = new Containership();

        $form = $this->createForm(ContainershipFormType::class, $containership);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($containership);
            $this->manager->flush();
        }
        return $this->render('containershipform.html.twig', [
            'form' => $form->createView(),
        ]);


    }
}
