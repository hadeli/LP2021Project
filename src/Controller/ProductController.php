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
     * @Route("/product", name="getAllProduct" , methods={"GET"})
     *
     */
    public function getAllProduct()
    {
        $manager = $this->getDoctrine()->getManager();
        $containerList = $manager->getRepository(Product::class)->findAll();
        return $this->json($containerList);
    }


    /**
     * @Route("/product/{id}", name="getProductById",methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function getProductById(int $id)
    {
        return $this->json($this->getDoctrine()
            ->getRepository(Product::class)->find($id));
    }

    /**
     * @Route("/product/new", name="postProduct",methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function postProduct(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $product = $this->createFromRequest($request);
        $manager->persist($product);
        $manager->flush();

        return $this->json($product);
    }

    private function createFromRequest(Request $request): Product
    {
        return new Product($request->get('name'),
            $request->get('length'),
            $request->get('width'),
            $request->get('height')
        );
    }
}
