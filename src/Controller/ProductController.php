<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\Containership;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="app_product")
     */
    public function productShow(): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $productList = $manager->getRepository(Product::class)
            ->findAll();

        return $this->json($productList);
    }

    /**
     * @Route("/product/{id}", name="app_product_id")
     */
    public function productIdShow($id): Response
    {

        $request = Request::createFromGlobals();
        $product = new Product();

        switch ($request->getMethod()) {
            case 'POST':
                if($id == 'new') {
                    $manager = $this->getDoctrine()->getManager();

                    if(isset($_POST['name'])) {
                        $product->setName($_POST['name']);
                    }

                    if (isset($_POST['length'])) {
                        $product->setLength($_POST['length']);
                    }

                    if( isset($_POST['width'])){
                        $product->setWidth($_POST['width']);
                    }

                    if( isset($_POST['height'])){
                        $product->setHeight($_POST['height']);
                    }

                    $manager->persist($product);
                    $manager->flush();
                }
                break;
            default:
                $manager = $this->getDoctrine()->getManager();
                $product = $manager->getRepository(Product::class)
                    ->findOneBy(['id' => $id]);

                if ($product == NULL) {
                    $container = [
                        'error' => 'Aucun produit avec id = ' . $id
                    ];
                }
        }

        return $this->json($product);
    }
}
