<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("/product/{id}", name="getProduct", methods={"GET"}, requirements={"id"="\d+"})
     * @param int $id
     * @return JsonResponse
     */
    public function getProduct(int $id): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Product::class)->find($id));
    }

    /**
     * @Route("/product/new", name="newProduct", methods={"POST", "GET"})
     * @param Request $request
     * @return Response
     */
    public function newProduct(Request $request): Response
    {

        if ($request->request->has('name') && $request->request->has('length') && $request->request->has('width') && $request->request->has('height')) {

            $managerEntity = $this->getDoctrine()->getManager();
            $product = new Product();
            $product->setName($request->request->get('name'));
            $product->setLength($request->request->get('length'));
            $product->setWidth($request->request->get('width'));
            $product->setHeight($request->request->get('height'));
            $managerEntity->persist($product);
            $managerEntity->flush();
            return new Response('The product ' .$product->getName().' has been successfully added');
        } else{
            return $this->render('product/product.html.twig');
        }
    }
}
