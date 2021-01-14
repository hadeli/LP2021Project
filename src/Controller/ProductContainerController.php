<?php

namespace App\Controller;

use App\Entity\ContainerProduct;
use App\Entity\Product;
use App\Repository\ContainerRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product-container")
 */
class ProductContainerController extends AbstractController
{
    /**
     * @Route("/new", name="newProductContainer", methods={"GET"})
     * @param Request $request
     * @param ProductRepository $productRepository
     * @param ContainerRepository $containerRepository
     * @return JsonResponse
     */
    public function new(Request $request, ProductRepository $productRepository, ContainerRepository $containerRepository): JsonResponse
    {
        // Required values in GET parameters : productId, containerId, quantity
        $productId = $request->query->get('productId');
        $containerId = $request->query->get('containerId');
        $quantity = $request->query->get('quantity');

        // Parameters detected
        if ($productId && $containerId && $quantity) {

            $product = $productRepository->find($productId);
            $container = $containerRepository->find($containerId);

            // Product and container exist
            if (!$product || !$container) {
                return $this->json('Incorrect productId or containerId');
            }

            // Get product volume, container volume and products in container
            $productVolume = $product->getLength() * $product->getWidth() * $product->getHeight();
            $containerVolume =
                $container->getContainerModel()->getLength() *
                $container->getContainerModel()->getWidth() *
                $container->getContainerModel()->getHeight();
            $productsInContainer = $container->getContainerProducts();

            // Get current volume used in container
            $volumeUsed = 0;
            foreach ($productsInContainer as $product) {
                $volume = $product->getLength() * $product->getWidth() * $product->getHeight();
                $volumeUsed += $volume;
            }

            // Does my new products fit inside
            if ($containerVolume > $volumeUsed + $productVolume * $quantity) {
                $cp = new ContainerProduct();
                $cp
                    ->setProduct($product)
                    ->setContainer($container)
                    ->setQuantity($quantity);
                $container->addContainerProduct($cp);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($cp);
                $entityManager->persist($container);
                $entityManager->flush();

                return $this->json($container);
            }
            return $this->json('The product(s) cannot fit inside the container');
        }
        return $this->json('Error in parameters. Needed : [productId, containerId, quantity]');
    }
}
