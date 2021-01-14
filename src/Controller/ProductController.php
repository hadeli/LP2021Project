<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="getProducts", methods={"GET"})
     * @param ProductRepository $productRepository
     * @return JsonResponse
     */
    public function getAll(ProductRepository $productRepository): JsonResponse
    {
        return $this->json($productRepository->findAll());
    }

    /**
     * @Route("/new", name="newProduct", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function new(Request $request): JsonResponse
    {
        // Required values in GET parameters : name, length, width, height
        $name = $request->query->get('name');
        $length = $request->query->get('length');
        $width = $request->query->get('width');
        $height = $request->query->get('height');

        if (!$name || !$length || !$width || !$height) {
            return $this->json('Error in parameters. Needed : [name, length, width, height]');
        }

        $product = new Product();
        $product
            ->setName($name)
            ->setLength($length)
            ->setWidth($width)
            ->setHeight($height);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();

        return $this->json($product);
    }

    /**
     * @Route("/{id}", name="getProduct", methods={"GET"})
     * @param int $id
     * @param ProductRepository $productRepository
     * @return JsonResponse
     */
    public function getById(int $id, ProductRepository $productRepository): JsonResponse
    {
        return $this->json($productRepository->findBy(['id' => $id]));
    }
}
