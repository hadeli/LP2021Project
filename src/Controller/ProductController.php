<?php


namespace App\Controller;


use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
// ...

class ProductController extends AbstractController
{

    /**
     * @return Response
     */
    public function getAllProduct(): Response
    {
        $Product = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->json([$Product]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getProductById(int $id): JsonResponse
    {
        $Product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        return $this->json([$Product]);
    }





}