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
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function newContainerProduct(Request $request): Response
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

            $containerLimit =
                $containerProduct->getContainer()->getContainerModel()->getLength() *
                $containerProduct->getContainer()->getContainerModel()->getHeight() *
                $containerProduct->getContainer()->getContainerModel()->getWidth();

            $productToInsert = ($containerProduct->getProduct()->getLength() * $containerProduct->getProduct()->getHeight() * $containerProduct->getProduct()->getWidth())
                * $containerProduct->getQuantity();

            $allProduct = $this->manager->getRepository(ContainerProduct::class)->findBy([
                'container' => $containerProduct->getContainer()->getContainerModel()->getId()
            ]);

            $productLimit = 0;

            foreach ($allProduct as $product) {
                $productLimit += ($product->getProduct()->getLength() * $product->getProduct()->getWidth() * $product->getProduct()->getHeight()) * $product->getQuantity();
            }

            if ($containerLimit - $productLimit < $productToInsert) {
                $this->addFlash('error', 'Vous avez dépassé la place limite du conteneur !');
            } else {
                $this->manager->persist($containerProduct);
                $this->manager->flush();

                $message = $form['quantity']->getData() > 1 ? 'Les produits ont été ajouter dans le conteneur !' : 'Le produit a été ajouter dans le conteneur !';
                $this->addFlash('success', $message);
            }
        }

        return $this->render('containerProduct.html.twig', [
            'formContainerProduct' => $form->createView()
        ]);
    }
}