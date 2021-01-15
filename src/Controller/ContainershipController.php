<?php

namespace App\Controller;

use App\Entity\Containership;
use App\Repository\ContainershipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/containership")
 */
class ContainershipController extends AbstractController
{
    /**
     * @Route("/", name="getContainerships", methods={"GET"})
     * @param ContainershipRepository $containershipRepository
     * @return JsonResponse
     */
    public function getAll(ContainershipRepository $containershipRepository): JsonResponse
    {
        return $this->json($containershipRepository->findAll());
    }

    /**
     * @Route("/new", name="newContainership", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function new(Request $request): JsonResponse
    {
        // Required values in GET parameters : name, captainName, containerLimit
        $name = $request->query->get('name');
        $captainName = $request->query->get('captainName');
        $containerLimit = $request->query->get('containerLimit');

        if (!$name || !$captainName || !$containerLimit) {
            return $this->json('Error in parameters. Needed : [name, captainName, containerLimit]');
        }

        $containership = new Containership();
        $containership
            ->setName($name)
            ->setCaptainName($captainName)
            ->setContainerLimit($containerLimit);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($containership);
        $entityManager->flush();

        return $this->json($containership);
    }

    /**
     * @Route("/{id}", name="getContainership", methods={"GET"})
     * @param int $id
     * @param ContainershipRepository $containershipRepository
     * @return JsonResponse
     */
    public function getById(int $id, ContainershipRepository $containershipRepository): JsonResponse
    {
        return $this->json($containershipRepository->findBy(['id' => $id]));
    }
}
