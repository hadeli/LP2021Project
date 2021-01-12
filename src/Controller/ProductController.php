<?php

// src/Controller/ContainerController.php
namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

    public function CreateProduct(Request $request): Response
    {
        if ($request->query->has('name') && $request->query->has('length') && $request->query->has('width') && $request->query->has('height')) {
            echo 'GET';

            $manager = $this->getDoctrine()->getManager();
            $product = new Product();
            $product->setName($request->query->get('name'));
            $product->setLength($request->query->get('length'));
            $product->setWidth($request->query->get('width'));
            $product->setHeight($request->query->get('height'));
            $manager->persist($product);
            $manager->flush();

            return $this->json($product);
        } elseif ($request->request->has('name') && $request->request->has('length') && $request->request->has('width') && $request->request->has('height')) {
            echo 'POST';
            //do something
            $manager = $this->getDoctrine()->getManager();
            $product = new Product();
            $product->setName($request->request->get('name'));
            $product->setLength($request->request->get('length'));
            $product->setWidth($request->request->get('width'));
            $product->setHeight($request->request->get('height'));
            $manager->persist($product);
            $manager->flush();

            return $this->json($product);
        } else {
            return $this->render('Product/Product.html.twig');
            //return $this->json(['The Post or get does not have name, captainName and containerLimit' ]);
        }
    }
}
