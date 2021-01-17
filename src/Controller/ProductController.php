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

//    /**
//     * @param int $id
//     * @return JsonResponse
//     */
//    public function getProductById(int $id): JsonResponse
//    {
//        $Product = $this->getDoctrine()->getRepository(Product::class)->find($id);
//        return $this->json([$Product]);
//    }

    /**
     * @param Request $request
     * @return Response
     */
    public function createProduct(Request $request)
    {

        $manager = $this->getDoctrine()->getManager();
        $product = new Product();
        $product->setName($request->get('name'));
        $product->setHeight($request->get('height'));
        $product->setLength($request->get('length'));
        $product->setWidth($request->get('width'));

        $manager->persist($product);
        $manager->flush();

        return $this->json($product);
    }




}