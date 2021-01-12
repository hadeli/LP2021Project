<?php


// src/Controller/ContainerController.php
namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerProduct;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// ...

class ProductContainerController extends AbstractController
{

    public function CreateProductContainer(Request $request): Response
    {
        $ProductContainer = new ContainerProduct();
        $form =$this->createFormBuilder($ProductContainer)
            ->add('container', EntityType::class, [
                'class' => Container::class,
                'choice_label' => 'id'
            ])
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name'
            ])
            ->add('quantity', IntegerType::class)
            ->add('submit', SubmitType::class, ['label'=>'Create Container Product'])
            ->getForm()
        ;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated

            $ProductContainer = $form->getData();

            // ... perform some action, such as saving the task to the database

            $VolumeContainer = $ProductContainer->getContainer()->getContainerModel()->getlength() * $ProductContainer->getContainer()->getContainerModel()->getWidth() * $ProductContainer->getContainer()->getContainerModel()->getHeight();


            $VolumeProduct = $ProductContainer->getProduct()->getLength() * $ProductContainer->getProduct()->getWidth() * $ProductContainer->getProduct()->getHeight();
            $VolumeProducts = $VolumeProduct * $ProductContainer->getQuantity();


            $ContainerQuerry = $this->getDoctrine()->getRepository(ContainerProduct::class)->findBy(['container' => $ProductContainer->getContainer()]);

            $sumVolume = 0;
            foreach($ContainerQuerry as $obj) {
                $currVolume = $obj->getProduct()->getLength() * $obj->getProduct()->getHeight() * $obj->getProduct()->getWidth() * $obj->getQuantity();
                $sumVolume = $sumVolume + $currVolume;
            }

            $totalVolumeProduct = $VolumeProducts + $sumVolume;


            if ($VolumeContainer > $totalVolumeProduct) {
//               for example, if Task is a Doctrine entity, save it!
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($ProductContainer);
                $entityManager->flush();
                // c'est pas très propre, je sais
                echo '<p>Container Ajouté</p> <br>';
                echo '<p>Le volume du conteneur est inférieur au Volume des Produits, les produits peuvent rentrer dans le container ! :)</p> <br>';

            } else {
                echo 'Le volume du conteneur est supérieur au Volume des Produits, les produits ne peuvent pas rentrer dans le container';
            }

            //je sais pas s'il faut le faire ça ....
            //return $this->redirectToRoute('task_success');
        }

        return $this->render('ProductContainer/ProductContainer.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
