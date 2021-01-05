<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{

    public function getAllProduct(): JsonResponse
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->json([$product]);
    }

    public function getProduct($id): JsonResponse
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        return $this->json([$product]);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $manager
     */
    public function newProduct(Request $request, EntityManagerInterface $manager)
    {
        $product = new Product();

        $form = $this->createFormBuilder($product)
            ->add('name')
            ->add('length')
            ->add('width')
            ->add('height')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {

            $this->addFlash("success", "Le produit " . $product->getName() . " à bien été ajouté.");
            $manager->persist($product);
            $manager->flush();
        }


        return $this->render('Product/product.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}