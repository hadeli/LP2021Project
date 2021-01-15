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
    /**
     * @Route("/product", name="product")
     */
    public function index(): Response
    {
        return $this->json($this->getDoctrine()->getRepository(Product::class)->findAll());
    }

    /**
     * @Route("/product/{id}", methods={"GET"})
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        return $this->json($this->getDoctrine()->getRepository(Product::class)->find($id));
    }

    /**
     * @Route("/product_new")
     * @param Request $request
     * @return Response
     */
    public function createProduct(Request $request)
    {
        $product = new Product();
        $productForm = $this->createForm(ProductFormType::class, $product);
        $productForm->handleRequest($request);

        if ($productForm->isSubmitted() && $productForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
        }

        return $this->render('product/new.html.twig', [
            'form' => $productForm->createView(),
        ]);
    }


    /**
     * @Route("/product-container_new")
     * @param Request $request
     * @return Response
     */
    public function createProductContainer(Request $request)
    {
        $containerProduct = new ContainerProduct();
        $containerProductForm = $this->createForm(ContainerProductFormType::class, $containerProduct);
        $containerProductForm->handleRequest($request);

        if ($containerProductForm->isSubmitted() && $containerProductForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($containerProduct);
            $em->flush();
        }

        return $this->render('container_product/new.html.twig', [
            'form' => $containerProductForm->createView(),
        ]);
    }
}
