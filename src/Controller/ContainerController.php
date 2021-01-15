<?php

namespace App\Controller;

use App\Entity\Container;
use App\Form\ContainerFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerController extends AbstractController
{
    private $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/container", name="containersList" , methods={"GET"})
     */
    public function containersList()
    {

        return $this->json($this->getDoctrine()->getRepository(Container::class)->findAll());
    }

    /**
     * @Route("/container/{id}", name="containersById" , methods={"GET"})
     * @param $id
     * @return JsonResponse
     */
    public function containersById(int $id)
    {
        return $this->json($this->getDoctrine()->getRepository(Container::class)->find($id));
    }

    /**
     * @Route("/containers/new", name="containerAdd", methods={"POST"})
     * @param $request
     * @return Response
     */
    public function containerAdd(Request $request): Response
    {
        $container = new Container();

        $form = $this->createForm(ContainerFormType::class, $container);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($container);
            $this->manager->flush();
        }
        return $this->render('containerform.html.twig', [
            'form' => $form->createView(),
        ]);


    }

}
