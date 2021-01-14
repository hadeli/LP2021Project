<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\{IntegerType, SubmitType, TextType};
use Symfony\Component\HttpFoundation\{JsonResponse, Response, Request};


class ProductController extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getAllProduct(): JsonResponse
    {
        return $this->json($this->manager->getRepository(Product::class)->findAll());
    }

    public function getOneProduct(int $id): JsonResponse
    {
        return $this->json($this->manager->getRepository(Product::class)->find($id));
    }

    public function newProduct(Request $request): Response
    {
        $product = new Product();

        // Création du formulaire
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On insère les données dans la base de données
            $this->manager->persist($product);
            $this->manager->flush();

            $this->addFlash('success', 'Le produit "' . $product->getName() . '" a été ajouter !');
        }

        return $this->render('product.html.twig', [
            'formProduct' => $form->createView()
        ]);
    }
}