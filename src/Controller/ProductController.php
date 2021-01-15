<?php

namespace App\Controller;

use App\Entity\ContainerProduct;
use App\Entity\Product;
use App\Form\ContainerProductFormType;
use App\Form\ProductFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProductController extends AbstractController
{

    public function index(): Response
    {
        return $this->json($this->getDoctrine()->getRepository(Product::class)->findAll());
    }


    public function show($id): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Product::class)->find($id));
    }


    public function createProduct(Request $request)
    {
        $product = new Product();
        $productForm = $this->createForm(ProductFormType::class, $product);
        $productForm->handleRequest($request);

        if ($productForm->isSubmitted() && $productForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirect('/product');
        }

        return $this->render('product/new.html.twig', [
            'form' => $productForm->createView(),
        ]);
    }



    public function createProductContainer(Request $request)
    {
        $containerProduct = new ContainerProduct();
        $containerProductForm = $this->createForm(ContainerProductFormType::class, $containerProduct);
        $containerProductForm->handleRequest($request);

        if ($containerProductForm->isSubmitted() && $containerProductForm->isValid()) {

            $containerLimit =
                $containerProduct->getContainer()->getContainerModel()->getLength() *
                $containerProduct->getContainer()->getContainerModel()->getHeight() *
                $containerProduct->getContainer()->getContainerModel()->getWidth();


            $productToInsert = ($containerProduct->getProduct()->getLength() * $containerProduct->getProduct()->getHeight() * $containerProduct->getProduct()->getWidth())
                * $containerProduct->getQuantity();


            $allProduct = $this->getDoctrine()->getRepository(ContainerProduct::class)->findBy([
                'container' => $containerProduct->getContainer()->getContainerModel()->getId()
            ]);

            $productLimit = 0;

            foreach ($allProduct as $product) {
                $productLimit += ($product->getProduct()->getLength() * $product->getProduct()->getWidth() * $product->getProduct()->getHeight()) * $product->getQuantity();
            }

            if ($containerLimit - $productLimit < $productToInsert) {
                $this->addFlash('error', 'Vous avez dépassé la place limite du conteneur !');
                return $this->redirect('/product-container/new');
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($containerProduct);
            $em->flush();
            return $this->redirect('/container');
        }

        return $this->render('container_product/new.html.twig', [
            'form' => $containerProductForm->createView(),
        ]);
    }
}
