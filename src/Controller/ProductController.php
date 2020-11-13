<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="getProducts", methods={"GET"})
     * @param ProductRepository $productRepository
     * @return JsonResponse
     */
    public function getAll(ProductRepository $productRepository): JsonResponse
    {
        return $this->json($productRepository->findAll());
    }

    /**
     * @Route("/add", name="addProduct")
     * @return JsonResponse
     */
    public function add(): JsonResponse
    {
        $product = $this->generateOne();

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();

        return $this->json($product);
    }

    /**
     * @Route("/{id}", name="getProduct", methods={"GET"})
     * @param int $id
     * @param ProductRepository $productRepository
     * @return JsonResponse
     */
    public function getById(int $id, ProductRepository $productRepository): JsonResponse
    {
        return $this->json($productRepository->findBy(['id' => $id]));
    }

    private function generateOne(): Product {
        $product = new Product();
        $product
            ->setName("Product #".time())
            ->setLength(rand(50,20000))
            ->setWidth(3000)
            ->setHeight(3000);
        return $product;
    }
}
