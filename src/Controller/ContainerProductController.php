<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerModel;
use App\Entity\ContainerProduct;
use App\Entity\ContainerShip;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ContainerProductController extends AbstractController
{

    public function newContainerProduct(Request $request, EntityManagerInterface $entityManager)
    {
        $container_product = new ContainerProduct();

        $form = $this->createFormBuilder($container_product)
            ->add('container', EntityType::class, [
                'class' => Container::class,
                'choice_label' => 'id'
            ])
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name'
            ])
            ->add('quantity')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /**
             * Limite d'un conteneur 
             */

            $getContainerModel = $this->getDoctrine()
                ->getRepository(ContainerModel::class)
                ->find($container_product->getContainer()->getContainerModel());

            $containerLimit = ($getContainerModel->getLength() * $getContainerModel->getWidth() * $getContainerModel->getHeight());

            $product = $container_product->getProduct();

            $ActualproductDimension = ($product->getLength() * $product->getWidth() * $product->getHeight()) * $container_product->getQuantity();

            $getContainerProduct = $this->getDoctrine()
                ->getRepository(ContainerProduct::class)
                ->findBy([
                    'container' => $container_product->getContainer()->getId(),
                ]);

            $limit = 0;
            foreach ($getContainerProduct as $productContainer) {

                $getProduct = $this->getDoctrine()->getRepository(Product::class)
                    ->find($productContainer->getProduct());
                $productDimension = ($getProduct->getLength() * $getProduct->getWidth() * $getProduct->getHeight()) * $productContainer->getQuantity();
                $limit += $productDimension;
            }
            $rest = $containerLimit - $limit;

            if ($rest < $ActualproductDimension) {
                $this->addFlash("error", "Le produit renseigné depasse la limite du conteneur #" . $container_product->getContainer()->getId());
            } else {
                $this->addFlash("success", "Produit(s) ajouté(s) au conteneur #" . $container_product->getContainer()->getId());
                $entityManager->persist($container_product);
                $entityManager->flush();
            }
        }

        return $this->render('container-product/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}