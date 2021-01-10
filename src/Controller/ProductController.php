<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="list_product")
     */
    public function showListProduct() : Response
    {
        return $this->json($this->getDoctrine()->getRepository(Product::class)->findAll());
    }

    /**
     * @Route("/product/{id}", name="product")
     */
    public function showSpecificProduct($id): Response
    {
        return $this->json($this->getDoctrine()->getRepository(Product::class)->find($id));
    }
}