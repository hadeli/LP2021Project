<?php

namespace App\Controller;

use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Serializer\Normalizer\ProductNormalizer;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product", methods={"GET"})
     */
    public function getAllProduct(ProductRepository $product, ProductNormalizer $normalizer): Response
    {
        $products = $product->findAll();
        $productsNormalize = [];
        foreach ($products as $p){
            $productsNormalize[] = $normalizer->normalize($p);
        }

        return $this->json($productsNormalize);
    }

    /**
     * @Route("/product/{id}", name="get_one_product",  methods={"GET"}, requirements={"id"="\d+"})
     */
    public function getOneProduct(int $id)
    {
        return $this->json($this->getDoctrine()->getRepository(Product::class)->find($id));
    }

    /**
     * @Route("/product/new", name="create_product")
     */
    public function createProduct(Request $request, ObjectManager $manager): Response
    {
        $product = new Product();
        $form = $this->createFormBuilder($product)
            ->add('name')
            ->add('width')
            ->add('length')
            ->add('height')
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($product);
            $manager->flush();

            return $this->redirectToRoute('product');
        }

        return $this->render('product/create.html.twig', [
            'formProduct' => $form->createView()
        ]);
    }
}
