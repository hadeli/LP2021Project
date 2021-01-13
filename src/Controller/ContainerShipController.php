<?php

namespace App\Controller;

use App\Entity\ContainerShip;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerShipController extends AbstractController
{
    /**
     * @Route("/containership", name="list_container_ship")
     */
    public function showListContainerShip() : Response
    {
        return $this->json($this->getDoctrine()->getRepository(ContainerShip::class)->findAll());
    }

    /**
     * @Route("/containership/{id}", name="container_ship")
     * @param $id
     * @return Response
     */
    public function specificContainerShip($id): Response
    {
        $containerShip = new Containership();
        $method = Request::createFromGlobals()->getMethod();

        if ($method === 'POST') {
            if ($id === 'new') {
                $manager = $this->getDoctrine()->getManager();

                if (isset($_POST['name'])) {
                    $containerShip->setName($_POST['name']);
                }

                if (isset($_POST['captain_name'])) {
                    $containerShip->setCaptainName($_POST['captain_name']);
                }

                if (isset($_POST['container_limit'])) {
                    $containerShip->setContainerLimit($_POST['container_limit']);
                }

                $manager->persist($containerShip);
                $manager->flush();
            }
        } else {
            $containerShip = $this->getDoctrine()->getRepository(ContainerShip::class)->find($id);

        }
        return $this->json($containerShip);
    }
}