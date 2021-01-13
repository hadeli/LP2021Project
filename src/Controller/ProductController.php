<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param $id
     * @return Response
     */
    public function specificProduct($id): Response
    {
        $product = new Product();
        $method = Request::createFromGlobals()->getMethod();

        if ($method === 'POST') {
            if ($id === 'new') {
                $manager = $this->getDoctrine()->getManager();

                if (isset($_POST['name'])) {
                    $product->setName($_POST['name']);
                }

                if (isset($_POST['length'])) {
                    $product->setLength($_POST['length']);
                }

                if (isset($_POST['width'])) {
                    $product->setWidth($_POST['width']);
                }

                if (isset($_POST['height'])) {
                    $product->setHeight($_POST['height']);
                }

                $manager->persist($product);
                $manager->flush();
            }
        } else {
            $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        }

        return $this->json($product);
    }
}