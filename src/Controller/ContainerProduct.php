<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ContainerProduct as ContainerProductEntity;
use App\Entity\Product as ProductEntity;
use App\Entity\Container as ContainerEntity;

class ContainerProduct extends AbstractController {

    /**
     * @Route("/product-container/new", name="product-container_new", methods={"PUT"})
     * @param Request $request
     * @return Response
     */
    public function create (Request $request) : Response {

        $paramsRequire = ['Quantity', 'Product', 'Container'];
        foreach ($request->query->keys() as $k) if (!in_array($k, $paramsRequire)) return new Response("Champ(s) manquant(s)");

        $product = $this->getDoctrine()->getRepository(ProductEntity::class)->find($request->query->getInt("Product"));
        if (!$product) return new Response("Produit introuvable");

        $container = $this->getDoctrine()->getRepository(ProductEntity::class)->find($request->query->getInt("Container"));
        if (!$container) return new Response("Container introuvable");

        $entityManager = $this->getDoctrine()->getManager();

        $containerProduct = new ContainerProductEntity();
        $containerProduct->setContainer($container);
        $containerProduct->setProduct($product);
        $containerProduct->setQuantity($request->query->getInt("Quantity"));

        $entityManager->persist($containerProduct);
        $entityManager->flush();

        return new Response("ok");

    }

}