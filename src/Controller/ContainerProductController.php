<?php

namespace App\Controller;

use App\Entity\ContainerProduct;
use App\Form\ContainerProductFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerProductController extends AbstractController
{
    private $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/containerproducts/new", name="containerProductAdd", methods={"POST"})
     * @param $request
     * @return Response
     */
    public function containerProductAdd(Request $request): Response
    {
        $containerProduct = new ContainerProduct();

        $form = $this->createForm(ContainerProductFormType::class, $containerProduct);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($containerProduct);
            $this->manager->flush();
        }
        return $this->render('containerproductform.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
