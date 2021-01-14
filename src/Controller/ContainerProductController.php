<?php


namespace App\Controller;

use App\Form\ContainerProductType;
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

        // Création du formulaire
        $form = $this->createForm(ContainerProductType::class, $containerProduct);
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

            // Règle métier : Limite d'un conteneur
            if ($containerLimit - $productLimit < $productToInsert) {
                $this->addFlash('error', 'Vous avez dépassé la place limite du conteneur !');
            } else {
                // On insère les données dans la base de données
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