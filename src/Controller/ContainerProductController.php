<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ContainerProduct;

class ContainerProductController extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/product-container/new", name="container_product")
     */
    public function addProductToContainer(Request $request): Response
    {
        $containerProduct = new ContainerProduct();

        $form = $this->createFormBuilder($containerProduct)
            ->add('container', EntityType::class, [
                'class' => Container::class,
                'choice_label' => 'id',
                'label' => 'Containers : '
            ])
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name',
                'label' => 'Products : '
            ])
            ->add('quantity', IntegerType::class, [
                'label' => 'Product quantity : ',
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Rule
            $nbProductToInsert = ($containerProduct->getProduct()->getLength() * $containerProduct->getProduct()->getHeight() * $containerProduct->getProduct()->getWidth())
                * $containerProduct->getQuantity();

            $containerLimit =
                $containerProduct->getContainer()->getContainerModel()->getLength() *
                $containerProduct->getContainer()->getContainerModel()->getHeight() *
                $containerProduct->getContainer()->getContainerModel()->getWidth();

            $allProduct = $this->manager->getRepository(ContainerProduct::class)->findBy([
                'container' => $containerProduct->getContainer()->getContainerModel()->getId()
            ]);
            $productLimit = 0;
            foreach ($allProduct as $product) {
                $productLimit += ($product->getProduct()->getLength() * $product->getProduct()->getWidth() * $product->getProduct()->getHeight()) * $product->getQuantity();
            }

            if ($nbProductToInsert > $containerLimit - $productLimit) {
                echo "Le conteneur est plein, vous ne pouvez plus ajouter de produit dedans ...";
            } else {
                $this->manager->persist($containerProduct);
                $this->manager->flush();

                return $this->render('product-container/success.html.twig');
            }
        }

        return $this->render('product-container/addProduct.html.twig', [
            'formContainerProduct' => $form->createView()
        ]);
    }
}
