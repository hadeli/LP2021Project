<?php


// src/Controller/ContainerController.php
namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerProduct;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// ...

class ProductContainerController extends AbstractController
{

    public function CreateProductContainer(Request $request): Response
    {
        if ($request->request->has('containerID') && $request->request->has('productID') && $request->request->has('quantity')) {
            echo 'POST';

            //il faut verifier que le produit rentre bien dans le container


            $manager = $this->getDoctrine()->getManager();
            $product = new ContainerProduct();

            $container = $this->getDoctrine()->getRepository(Container::class)->find($request->request->get('containerID'));

            $product->setContainerById($container);

            $Product = $this->getDoctrine()->getRepository(Container::class)->find($request->request->get('productID'));
            $product->setProduct($Product);

            $product->setQuantity($request->request->get('quantity'));
            $manager->persist($product);
            $manager->flush();

            return $this->json($product);
        } else {
            $tableProduct = $this->getDoctrine()->getRepository(Product::class)->findAll();
            $tableContainer = $this->getDoctrine()->getRepository(Container::class)->findAll();
            return $this->render('ProductContainer/ProductContainer.html.twig', ['tableProduct'=>$tableProduct,'tableContainer'=>$tableContainer ]);

            //return $this->json(['The Post or get does not have name, captainName and containerLimit' ]);
        }
    }
}
