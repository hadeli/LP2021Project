<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerProduct;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product-container")
 */
class ContainerProductController extends AbstractController
{
    /**
     * @Route("/new", name="set_new_product-container",  methods={"GET|POST"})
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function createAction(Request $request, EntityManagerInterface  $manager)
    {
        $containerproduct = new ContainerProduct();

        $form = $this->createFormBuilder($containerproduct)
            ->add('container', EntityType::class, [
                'class' => Container::class,
                'choice_label' => 'id'
            ])
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'id'
            ])
            ->add('quantity', NumberType::class)
            ->add('button', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($containerproduct);
            $manager->flush();

            return $this->redirectToRoute('get_one_container', ['id' => $containerproduct->getContainer()->getId()]);
        }

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}