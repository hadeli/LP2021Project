<?php

// src/Controller/ContainerController.php
namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
// ...

class ProductController extends AbstractController
{
    //return container id
    public function GetProduct(int $id): JsonResponse
    {
        $Product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        return $this->json([$Product]);
    }

    //return all containers
    public function ListProducts(): JsonResponse
    {
        $Product = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->json([$Product]);
    }
}
