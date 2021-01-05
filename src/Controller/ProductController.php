<?php

namespace App\Controller;

use App\Entity\Product;
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

        $form = $this->createFormBuilder($product)
            ->add('name', TextType::class, [
                'label' => 'Nom du produit : ',
                'attr' => [
                    'placeholder' => 'Nom du produit'
                ]
            ])
            ->add('length', IntegerType::class, [
                'label' => 'Longueur du produit : ',
                'attr' => [
                    'placeholder' => 'Longueur du produit'
                ]
            ])
            ->add('width', IntegerType::class, [
                'label' => 'Largeur du produit : ',
                'attr' => [
                    'placeholder' => 'Largeur du produit'
                ]
            ])
            ->add('height', IntegerType::class, [
                'label' => 'Hauteur du produit : ',
                'attr' => [
                    'placeholder' => 'Hauteur du produit'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($product);
            $this->manager->flush();

            $message = 'Le produit "' . $product->getName() . '" a été ajouter !';

            return $this->render('product.html.twig', [
                'formProduct' => $form->createView(),
                'msg' => $message
            ]);
        }

        return $this->render('product.html.twig', [
            'formProduct' => $form->createView()
        ]);
    }
}