<?php

namespace App\Controller;

use App\Entity\Container;
use App\Repository\ContainerModelRepository;
use App\Repository\ContainerRepository;
use App\Repository\ContainershipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/container")
 */
class ContainerController extends AbstractController
{
    /**
     * @Route("/", name="getContainers", methods={"GET"})
     * @param ContainerRepository $containerRepository
     * @return JsonResponse
     */
    public function getAll(ContainerRepository $containerRepository): JsonResponse
    {
        return $this->json($containerRepository->findAll());
    }

    /**
     * @Route("/new", name="newContainer", methods={"GET"})
     * @param Request $request
     * @param ContainerModelRepository $containerModelRepository
     * @param ContainershipRepository $containershipRepository
     * @return JsonResponse
     */
    public function new(Request $request, ContainerModelRepository $containerModelRepository, ContainershipRepository $containershipRepository): JsonResponse
    {
        // Required values in GET parameters : color, containerModelId, containershipId
        $color = $request->query->get('color');
        $containerModelId = $request->query->get('containerModelId');
        $containershipId = $request->query->get('containershipId');

        // Parameters detected
        if (!$color || !$containerModelId || !$containershipId) {
            return $this->json('Error in parameters. Needed : [color, containerModelId, containershipId]');
        }

        $containerModel = $containerModelRepository->find($containerModelId);
        $containership = $containershipRepository->find($containershipId);

        // Container model and containership exist
        if (!$containerModel || !$containership) {
            return $this->json('Incorrect containerModelId or containershipId');
        }

        // Are we still in the containership containers limit after adding a new one
        if ($containership->getContainerLimit() >= count($containership->getContainers()) + 1) {
            $container = new Container();
            $container
                ->setColor($color)
                ->setContainerModel($containerModel)
                ->setContainership($containership);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($container);
            $entityManager->flush();

            return $this->json($container);
        }
        return $this->json('The containership is already full');
    }

    /**
     * @Route("/{id}", name="getContainer", methods={"GET"})
     * @param int $id
     * @param ContainerRepository $containerRepository
     * @return JsonResponse
     */
    public function getById(int $id, ContainerRepository $containerRepository): JsonResponse
    {
        return $this->json($containerRepository->findBy(['id' => $id]));
    }
}
