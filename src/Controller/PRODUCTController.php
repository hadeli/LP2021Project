<?php

namespace App\Controller;

use App\Entity\CONTAINERPRODUCT;
use App\Repository\PRODUCTRepository;
use App\Serializer\Normalizer\PRODUCTNormalizer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PRODUCT;
use App\Entity\CONTAINER;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PRODUCTController extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/product", name="product")
     */
    public function index(PRODUCTRepository $data, PRODUCTNormalizer $objet): Response
    {
        return $this->json($data->findAll());
    }

    /**
     * @Route("/product/{id}", name="get_one_product",  methods={"GET"}, requirements={"id"="\d+"})
     */
    public function getOneProduct(int $id)
    {
        return $this->json($this->getDoctrine()->getRepository(PRODUCT::class)->find($id));
    }
    /**
     * @Route("/product/new", name="new_product")
     */
    public function createView(Request $request): Response
    {

        $Product = new PRODUCT;
        $formProduct = $this->createFormBuilder($Product)
            ->add('Name',TextType::class, ['label' => 'Nom : '])
            ->add('Length',TextType::class, ['label' => 'Longueur : '])
            ->add('Width',TextType::class, ['label' => 'Largeur : '])
            ->add('Height',TextType::class, ['label' => 'Hauteur : '])
            ->add('Add_product', SubmitType::class, ['label' => 'Ajouter le produit'])
            ->getForm();

        $formProduct->handleRequest($request);

        if ($formProduct->isSubmitted() && $formProduct->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Product);
            $em->flush();

            return $this->json($Product);
        }

        return $this->render('product/PRODUCTview.html.twig', [
            'formProduct' => $formProduct->createView(),
        ]);

    }

    /**
     * @Route("/product-container/new", name="new_product_container")
     */
    public function createViewContainer(Request $request): Response
    {

        $ProductContainer = new CONTAINERPRODUCT();

        $formProductContainer = $this->createFormBuilder($ProductContainer)
            ->add('CONTAINER',EntityType::class, ['class' => CONTAINER::class, 'choice_label' => 'id', 'label' => 'Conteneur : '])
            ->add('product',EntityType::class, ['class' => PRODUCT::class, 'choice_label' => 'name','label' => 'Produit : '])
            ->add('quantity',IntegerType::class, ['label' => 'Quantité : '])
            ->add('Add_product', SubmitType::class, ['label' => 'Ajouter le produit'])
            ->getForm();

        $formProductContainer->handleRequest($request);

        if ($formProductContainer->isSubmitted() && $formProductContainer->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ProductContainer);
            $em->flush();

            return $this->json($ProductContainer);
        }

        return $this->render('productcontainer/PRODUCTCONTAINERview.html.twig', [
            'formProduct' => $formProductContainer->createView(),
        ]);

    }
}
