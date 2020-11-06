<?php

namespace App\Controller;

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
     * @Route("/{id}", name="getProduct",  methods={"GET"})
     * @param int $id
     * @param ProductRepository $productRepository
     * @return JsonResponse
     */
    public function getById(int $id, ProductRepository $productRepository): JsonResponse
    {
        return $this->json($productRepository->findBy(['id' => $id]));
    }
}
