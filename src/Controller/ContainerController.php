<?php

namespace App\Controller;

use App\Entity\ContainerModel;
use App\Entity\Containership;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Container;
use App\Repository\ContainerRepository;
use App\Serializer\Normalizer\ContainerNormalizer;

class ContainerController extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/container", name="container", methods={"GET"})
     */
    public function getAllContainer(ContainerRepository $container, ContainerNormalizer $normalizer): Response
    {
        $containers = $container->findAll();
        $containersNormalize = [];
        foreach ($containers as $container){
            $containersNormalize[] = $normalizer->normalize($container);
        }

        return $this->json($containersNormalize);
    }

    /**
     * @Route("/container/{id}", name="get_one_container",  methods={"GET"}, requirements={"id"="\d+"})
     */
    public function getOneContainer(int $id)
    {
        return $this->json($this->getDoctrine()->getRepository(Container::class)->find($id));
    }

    /**
     * @Route("/container/new", name="create_container")
     */
    public function createContainer(Request $request): Response
    {

        $container = new Container();

        $form = $this->createFormBuilder($container)
            ->add('color', TextType::class, [
                'label' => 'Container color : ',
            ])
            ->add('containerModel', EntityType::class, [
                'class' => ContainerModel::class,
                'choice_label' => 'name',
                'label' => 'Container model : '
            ])
            ->add('containership', EntityType::class, [
                'class' => Containership::class,
                'choice_label' => 'name',
                'label' => 'Contanier ship : '
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $allContainers = $this->manager->getRepository(Container::class)->findBy([
                'containership' => $form['containership']->getData()
            ]);
            $containershipLimit = $container->getContainership()->getContainerLimit();

            //Rule
            if (count($allContainers) >= $containershipLimit) {
                echo "impossible de créer ce conteneur car le porte conteneur est déjà plein !";
            } else {
                $this->manager->persist($container);
                $this->manager->flush();

                return $this->redirectToRoute('container');
            }
        }

        return $this->render('container/create.html.twig', [
            'formContainer' => $form->createView()
        ]);
    }
}
