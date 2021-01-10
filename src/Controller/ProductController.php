<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="list_product")
     */
    public function showListProduct() : JsonResponse
    {
        $manager = $this->getDoctrine()->getManager();
        $list = $manager->getRepository(Product::class)->findAll();

        return $this->json($list);
    }
}