<?php

namespace App\Controller;

use App\Entity\CONTAINERMODEL;
use App\Entity\CONTAINERSHIP;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\CONTAINER;
use App\Repository\CONTAINERRepository;
use App\Serializer\Normalizer\CONTAINERNormalizer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CONTAINERController extends AbstractController
{

    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/container", name="container")
     */
    public function index(CONTAINERRepository $data, CONTAINERNormalizer $objet): Response
    {
        return $this->json($data->findAll());
    }

    /**
     * @Route("/container/{id}", name="get_one_container",  methods={"GET"}, requirements={"id"="\d+"})
     */
    public function getOneContainer(int $id)
    {
        return $this->json($this->getDoctrine()->getRepository(CONTAINER::class)->find($id));
    }

    /**
     * @Route("/container/new", name="new_container")
     */
    public function createViewNewContainer(Request $request): Response
    {

        $Container = new CONTAINER();

        $formContainer = $this->createFormBuilder($Container)
            ->add('COLOR',TextType::class, ['label' => 'Couleur : '])
            ->add('CONTAINERSHIP',EntityType::class, ['class' => CONTAINERSHIP::class, 'choice_label' => 'name','label' => 'Nom : '])
            ->add('CONTAINERMODEL',EntityType::class, ['class' => CONTAINERMODEL::class, 'choice_label' => 'name','label' => 'Modéle du conteneur : '])
            ->add('Add_product', SubmitType::class, ['label' => 'Ajouter un conteneur'])
            ->getForm();

        $formContainer->handleRequest($request);
        if ($formContainer->isSubmitted() && $formContainer->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Container);
            $em->flush();

        }

        return $this->render('container/CONTAINERview.html.twig', [
            'formProduct' => $formContainer->createView(),
        ]);

    }
}
