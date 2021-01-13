<?php

namespace App\Controller;

use App\Repository\ContainershipRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Containership;
use App\Serializer\Normalizer\ContainershipNormalizer;

class ContainershipController extends AbstractController
{
    /**
     * @Route("/containership", name="containership", methods={"GET"})
     */
    public function getAllContainerShip(ContainershipRepository $containerShip, ContainershipNormalizer $normalizer): Response{
        $containersShip = $containerShip->findAll();
        $containersShipNormalize = [];
        foreach ($containersShip as $contShip){
            $containersShipNormalize[] = $normalizer->normalize($contShip);
        }
        return $this->json($containersShipNormalize);
    }

    /**
     * @Route("/containership/{id}", name="get_one_containership", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function getOneContainerShip(int $id){
        return $this->json($this->getDoctrine()->getRepository(Containership::class)->find($id));
    }

    /**
     * @Route("/containership/new", name="create_containership")
     */
    public function createContainership(Request $request, ObjectManager $manager): Response
    {
        $containership = new Containership();
        $form = $this->createFormBuilder($containership)
            ->add('name')
            ->add('captain_name')
            ->add('container_limit')
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($containership);
            $manager->flush();

            return $this->redirectToRoute('containership');
        }

        return $this->render('containership/create.html.twig', [
            'formContainership' => $form->createView()
        ]);
    }
}
