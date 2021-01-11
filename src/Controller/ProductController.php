<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/containership")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="get_all_products", methods={"GET"})
     */
    public function getAllAction(): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Product::class)->findAll());
    }

    /**
     * @Route("/{id}", name="get_one_product",  methods={"GET"})
     */
    public function getOneAction(int $id): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Product::class)->find($id));
    }
}