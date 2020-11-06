<?php


namespace App\Controller;


use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class ProductController
 * @package App\Controller
 *
 */
class ProductController extends AbstractController
{

    /**
     * @Route("/product",name="getAllProduct",methods={"GET"})
     */
    public function getAllProduct(){
        return $this->json($this->getDoctrine()->getRepository(Product::class)->findAll());
    }

    /**
     * @Route("/product/{id}",name="getProductById",methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function getProductById(int $id){
        return $this->json($this->getDoctrine()->getRepository(Product::class)->find($id));
    }

    /**
     * @Route("/product/new",name="addProduct",methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function addProduct(Request $request){

        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setHeight($request->query->get('height'));
        $product->setLength($request->query->get('length'));
        $product->setWidth($request->query->get('width'));
        $product->setName($request->query->get('name'));

        $entityManager->persist($product);
        $entityManager->flush();

        return new Response('Produit ajouté a l\'id '.$product->getId());
    }

}