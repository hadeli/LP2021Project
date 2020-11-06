<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\Containership;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerController extends AbstractController
{
    /**
     * @Route("/container", name="app_container")
     */
    public function containerShow(): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $containerList = $manager->getRepository(Container::class)
                                 ->findAll();

        return $this->json($containerList);
    }

    /**
     * @Route("/container/{id}", name="app_container_id")
     */
    public function containerIdShow($id): Response
    {

        $request = Request::createFromGlobals();
        $container = new Container();

        switch ($request->getMethod()) {
            case 'POST':
                if($id == 'new') {
                    $manager = $this->getDoctrine()->getManager();
                    $ship = $manager->getRepository(Containership::class)
                        ->findOneBy(['id' => $_POST['containershipId']]);

                    $containers = $manager->getRepository(Container::class)
                        ->findBy(['containershipId' => $_POST['containershipId']]);

                    if((sizeof($containers) + 1) <= $ship->getContainerLimit()) {
                        if(isset($_POST['color'])) {
                            $container->setColor($_POST['color']);
                        }

                        if (isset($_POST['containerModelId'])) {
                            $container->setContainerModelId($_POST['containerModelId']);
                        }

                        if( isset($_POST['containershipId'])){
                            $container->setContainershipId($_POST['containershipId']);
                        }

                        $manager->persist($container);
                        $manager->flush();
                    } else {
                        $container = [
                            'error' => 'Ce bateau est plein !'
                        ];
                    }
                }
                break;
            default:
                $manager = $this->getDoctrine()->getManager();
                $container = $manager->getRepository(Container::class)
                    ->findOneBy(['id' => $id]);

                if ($container == NULL) {
                    $container = [
                        'error' => 'Aucun conteneur avec id = ' . $id
                    ];
                }
        }

        return $this->json($container);
    }
}
