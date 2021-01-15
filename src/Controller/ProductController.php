<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/product", name="productList" , methods={"GET"})
     */
    public function productList()
    {
        return $this->json($this->getDoctrine()->getRepository(Product::class)->findAll());
    }

    /**
     * @Route("/product/{id}", name="productById" , methods={"GET"})
     * @param $id
     * @return JsonResponse
     */
    public function productById(int $id)
    {
        return $this->json($this->getDoctrine()->getRepository(Product::class)->find($id));
    }

    /**
     * @Route("/products/new", name="productAdd", methods={"POST"})
     * @param $request
     * @return Response
     */
    public function productAdd(Request $request): Response
    {
        $product = new Product();

        $form = $this->createForm(ProductFormType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($product);
            $this->manager->flush();
        }
        return $this->render('productform.html.twig', [
            'form' => $form->createView(),
        ]);


    }
}
