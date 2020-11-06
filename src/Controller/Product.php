<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product as ProductEntity;

class Product extends AbstractController {

    /**
     * @Route ("/product", name="product_list", methods={"GET"})
     * @return Response
     */
    public function list() : Response {
        $products = $this->getDoctrine()->getRepository(ProductEntity::class)->findAll();
        dd($products);
        return new Response("Ok");
    }

    /**
     * @Route ("/product/{id}", name="product_details", methods={"GET"})
     * @return Response
     */
    public function details($id) : Response {
        $product = $this->getDoctrine()->getRepository(ProductEntity::class)->find($id);
        dd($product);
    }

    /**
     * @Route("/product/new", name="product_new", methods={"PUT"})
     * @param Request $request
     * @return Response
     */
    public function create (Request $request) : Response {

        $paramsRequire = ['Height', 'Length', 'Name', 'Width'];
        foreach ($request->query->keys() as $k) if (!in_array($k, $paramsRequire)) return new Response("Champ(s) manquant(s)");

        $entityManger = $this->getDoctrine()->getManager();

        $product = new ProductEntity();
        $product->setName($request->query->get('Name'));
        $product->setHeight($request->query->getInt('Height'));
        $product->setLength($request->query->getInt('Length'));
        $product->setWidth($request->query->getInt('Width'));

        $entityManger->persist($product);
        $entityManger->flush();

        return new Response("Ok");

    }

}