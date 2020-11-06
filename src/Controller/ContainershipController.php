<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\Containership;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainershipController extends AbstractController
{
    /**
     * @Route("/containership", name="app_containership")
     */
    public function containerShipShow(): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $containerShipList = $manager->getRepository(Containership::class)
            ->findAll();

        return $this->json($containerShipList);
    }

    /**
     * @Route("/containership/{id}", name="app_containership_id")
     */
    public function containershipIdShow($id): Response
    {

        $request = Request::createFromGlobals();
        $containership = new Containership();

        switch ($request->getMethod()) {
            case 'POST':
                if($id == 'new') {
                    $manager = $this->getDoctrine()->getManager();

                    if(isset($_POST['name'])) {
                        $containership->setName($_POST['name']);
                    }

                    if (isset($_POST['captainName'])) {
                        $containership->setCaptainName($_POST['captainName']);
                    }

                    if( isset($_POST['containerLimit'])){
                        $containership->setContainerLimit($_POST['containerLimit']);
                    }

                    $manager->persist($containership);
                    $manager->flush();
                }
                break;
            default:
                $manager = $this->getDoctrine()->getManager();
                $containership = $manager->getRepository(Containership::class)
                    ->findOneBy(['id' => $id]);

                if ($containership == NULL) {
                    $container = [
                        'error' => 'Aucun conteneurship avec id = ' . $id
                    ];
                }
        }

        return $this->json($containership);
    }
}
