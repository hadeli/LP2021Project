<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerProduct;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerProductController extends AbstractController
{
    /**
     * @Route("/product-container/{id}", name="getContainerProduct", methods={"GET"}, requirements={"id"="\d+"})
     * @param int $id
     * @return JsonResponse
     */
    public function getContainerProduct(int $id): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(ContainerProduct::class)->find($id));
    }

    /**
     * @Route("/product-container/new", name="newContainerProduct", methods={"POST", "GET"})
     * @param Request $request
     * @return Response
     */
    public function newContainerProduct(Request $request): Response
    {

            $containerProduct = new ContainerProduct();

            $form = $this->createFormBuilder($containerProduct)
                ->add('quantity')
                ->add('container', EntityType::class, [
                    'class' => Container::class,
                    'choice_label' => 'id'
                ])
                ->add('product', EntityType::class, [
                    'class' => Product::class,
                    'choice_label' => 'name'
                ])
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                 $entityManager = $this->getDoctrine()->getManager();
                 $entityManager->persist($containerProduct);
                 $entityManager->flush();
            }

            return $this->render("containerproduct/containerproduct.html.twig", [
                "form" => $form->createView(),
            ]);
    }
}
