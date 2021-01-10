<?php

// src/Controller/ContainerController.php
namespace App\Controller;

use App\Entity\Container;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
// ...

class ContainerController extends AbstractController
{

    public function GetContainer(int $id): Response
    {
        $container = $this->getDoctrine()
            ->getRepository(Container::class)
            ->find($id);

        if (!$container) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return new Response('Here are the characteristics of the container number '.$id." : ".$container->getColor());

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
}
