<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerModel;
use App\Entity\ContainerProduct;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerProductController extends AbstractController
{
    /**
     * @Route("/product-container/new", name="newContainerProduct", methods={"POST", "GET"})
     * @param Request $request
     * @return Response
     */
    public function newContainerProduct(Request $request): Response
    {

            $containerProduct = new ContainerProduct();

            $form = $this->createFormBuilder($containerProduct)
                ->add('quantity', IntegerType::class)
                ->add('container', EntityType::class, [
                    'class' => Container::class,
                    'choice_label' => 'id'
                ])
                ->add('product', EntityType::class, [
                    'class' => Product::class,
                    'choice_label' => 'name'
                ])
                ->add('submit', SubmitType::class, ['label' => 'Add'])
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $containerProduct = $form->getData();

                $productVolume = $containerProduct->getProduct()->getLength() * $containerProduct->getProduct()->getWidth() * $containerProduct->getProduct()->getHeight() * $containerProduct->getQuantity();


                $containerModel = $this->getDoctrine()->getRepository(ContainerModel::class)->find($containerProduct->getContainer()->getContainerModel());
                $containerVolume = $containerModel->getLength() * $containerModel->getWidth() * $containerModel->getHeight();

                $containers =  $this->getDoctrine()->getRepository(ContainerProduct::class)->findBy(['container' => $containerProduct->getContainer()]);

                $usedVolume = 0;

                foreach ($containers as $container){
                    $productInside = $this->getDoctrine()->getRepository(Product::class)->find($container->getProduct());
                    $usedVolume += $productInside->getLength() * $productInside->getWidth() * $productInside->getHeight();
                }

                $remainingVolume =  $containerVolume - $usedVolume;

                if($remainingVolume > $productVolume)
                {
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($containerProduct);
                    $entityManager->flush();

                    return new Response("Le produit a été ajouté dans le conteneur ".$containerProduct->getContainer()->getId());

                } else {

                    return new Response("Il n'y a pas assez de place dans le conteneur " .$containerProduct->getContainer()->getId());
                }
            }

            return $this->render("containerproduct/containerproduct.html.twig", [
                "form" => $form->createView(),
            ]);
    }
}
