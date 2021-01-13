<?php

namespace App\Controller;

use App\Entity\PRODUCT;

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
        return $this->json($this->getDoctrine()->getRepository(PRODUCT::class)->findAll());
    }

    /**
     * @Route("/product/{id}", name="product")
     * @param $id
     * @return Response
     */
    public function specificProduct($id): Response
    {
        $product = new PRODUCT();
        $method = Request::createFromGlobals()->getMethod();

        if ($method === 'POST') {
            if ($id === 'new') {
                $manager = $this->getDoctrine()->getManager();

                if (isset($_POST['name'])) {
                    $product->setNAME($_POST['name']);
                }

                if (isset($_POST['length'])) {
                    $product->setLENGTH($_POST['length']);
                }

                if (isset($_POST['width'])) {
                    $product->setWIDTH($_POST['width']);
                }

                if (isset($_POST['height'])) {
                    $product->setHEIGHT($_POST['height']);
                }

                $manager->persist($product);
                $manager->flush();
            }
        } else {
            $product = $this->getDoctrine()->getRepository(PRODUCT::class)->find($id);
        }

        return $this->json($product);
    }
}