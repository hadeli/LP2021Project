<?php


namespace App\Controller;

use App\Entity\{Container, ContainerProduct, Product};
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\{IntegerType, SubmitType};
use Symfony\Component\HttpFoundation\{Response, Request};


class ContainerProductController extends AbstractController
{
    public function newContainerProduct(Request $request, EntityManagerInterface $manager): Response
    {
        $containerProduct = new ContainerProduct();

        $form = $this->createFormBuilder($containerProduct)
            ->add('container', EntityType::class, [
                'class' => Container::class,
                'choice_label' => 'id',
                'label' => 'Liste des conteneurs : '
            ])
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name',
                'label' => 'Liste des produits : '
            ])
            ->add('quantity', IntegerType::class, [
                'label' => 'Quantité des produits : ',
                'attr' => [
                    'placeholder' => 'Quantité des produits'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($containerProduct);
            $manager->flush();

            $message = 'Le produit a été ajouter dans le conteneur';

            return $this->render('containerProduct.html.twig', [
                'formContainerProduct' => $form->createView(),
                'msg' => $message
            ]);
        }

        return $this->render('containerProduct.html.twig', [
            'formContainerProduct' => $form->createView()
        ]);
    }
}