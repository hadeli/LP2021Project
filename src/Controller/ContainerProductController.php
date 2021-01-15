<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerModel;
use App\Entity\ContainerProduct;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product-container")
 */
class ContainerProductController extends AbstractController
{
    /**
     * @Route("/new", name="set_new_product-container",  methods={"GET|POST"})
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function createAction(Request $request, EntityManagerInterface  $manager)
    {
        $containerproduct = new ContainerProduct();

        $form = $this->createFormBuilder($containerproduct)
            ->add('container', EntityType::class, [
                'class' => Container::class,
                'choice_label' => 'id'
            ])
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'id'
            ])
            ->add('quantity', NumberType::class)
            ->add('button', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getRepository(ContainerProduct::class);

        if($form->isSubmitted())
        {
            $containers = $repository->findBy(
                ['container' => $containerproduct->getContainer()->getId()]
            );

            $curr_product = $containerproduct->getProduct();
            if(isset($containers[0]))
            {
                $curr_container = $containers[0]->getContainer()->getContainerModel();
                $base_container = $max_volume = $containerproduct->getContainer()->getContainerModel();
                $product_volume = $containerproduct->getQuantity()*$curr_product->getHeight()*$curr_product->getWidth()*$curr_product->getLength();
                $available_volume = $curr_container->getHeight()*$curr_container->getWidth()*$curr_container->getLength();
                $max_volume = $base_container->getWidth()*$base_container->getHeight()*$base_container->getLength();

                if($product_volume+$available_volume > $max_volume )
                {
                    unset($manager);
                    return $this->render('index.html.twig', [
                        'form' => $form->createView(),
                        'error' => "Le conteneur n°" . $containerproduct->getContainer()->getId() .  " est plein. Veuillez essayer avec un autre conteneur. (" .
                            $product_volume . "mm + ". $available_volume . "mm = " . $product_volume+$available_volume . "mm est supérieur àu volume max de " . $max_volume . "mm)"
                    ]);
                }
            } else {
                $base_container = $max_volume = $containerproduct->getContainer()->getContainerModel();
                $product_volume = $containerproduct->getQuantity()*$curr_product->getHeight()*$curr_product->getWidth()*$curr_product->getLength();
                $available_volume = 0;
                $max_volume = $base_container->getWidth()*$base_container->getHeight()*$base_container->getLength();

                if($product_volume > $max_volume)
                {
                    unset($manager);
                    return $this->render('index.html.twig', [
                        'form' => $form->createView(),
                        'error' => "Veuillez insérer moins de produits dans le conteneur n°" . $containerproduct->getContainer()->getId() .  " est plein. Vous insérez trop de produits dans ce conteneur vide. (" .
                            $product_volume . "mm est supérieur àu volume max de " . $max_volume . "mm)"
                    ]);
                }
            }
        }

        if($form->isSubmitted() && $form->isValid()) {
            $curr_container = $containerproduct->getContainer()->getContainerModel();
            if(count($containers) < $curr_container->getHeight()*$curr_container->getWidth()*$curr_container->getLength())
            {
                $manager->persist($containerproduct);
                $manager->flush();
            }

            return $this->redirectToRoute('get_one_container', ['id' => $containerproduct->getContainer()->getId()]);
        }

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}