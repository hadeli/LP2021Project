<?php

namespace App\Controller;

use App\Entity\Containership;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @Route("/containership")
 */
class ContainerShipController extends AbstractController
{
    /**
     * @Route("/", name="get_all_containerships", methods={"GET"})
     */
    public function getAllAction(): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Containership::class)->findAll());
    }

    /**
     * @Route("/{id}", name="get_one_containership",  methods={"GET"})
     */
    public function getOneAction(int $id): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Containership::class)->find($id));
    }

    /**
     * @Route("/new", name="set_new_containership",  methods={"GET|POST"})
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function createAction(Request $request, EntityManagerInterface  $manager)
    {
        $containership = new Containership();

        $form = $this->createFormBuilder($containership)
            ->add('name', TextType::class)
            ->add('captainName', TextType::class)
            ->add('containerLimit', NumberType::class)
            ->add('button', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($containership);
            $manager->flush();

            return $this->redirectToRoute('get_one_containership', ['id' => $containership->getId()]);
        }

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}