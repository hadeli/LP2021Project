<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
