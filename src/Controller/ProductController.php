<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="listProducts", methods={"GET"})
     * @return JsonResponse
     */
    public function listProducts(): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Product::class)->findAll());
    }

    /**
     * @Route("/product/{id}", name="getProduct", methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function getProduct(int $id): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Product::class)->find($id));
    }
}
