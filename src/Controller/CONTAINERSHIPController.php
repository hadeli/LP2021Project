<?php

namespace App\Controller;


use App\Repository\CONTAINERRepository;
use App\Repository\CONTAINERSHIPRepository;
use App\Serializer\Normalizer\CONTAINERNormalizer;
use App\Serializer\Normalizer\CONTAINERSHIPNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\CONTAINERSHIP;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CONTAINERSHIPController extends AbstractController
{
    /**
     * @Route("/containership", name="containership")
     */
    public function index(CONTAINERSHIPRepository $data, CONTAINERSHIPNormalizer $objet): Response
    {
        return $this->json($data->findAll());
    }

    /**
     * @Route("/containership/{id}", name="get_one_containership", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function getOneContainerShip(int $id){
        return $this->json($this->getDoctrine()->getRepository(CONTAINERSHIP::class)->find($id));
    }
}
