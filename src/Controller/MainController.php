<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerModel;
use App\Entity\ContainerProduct;
use App\Entity\ContainerShip;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\ResponseInterface;

class MainController extends AbstractController
{

    /**
     * @Route("/container", name="app_container")
     */
    public function containerList(): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $containerList = $manager->getRepository(Container::class)->findAll();
        return $this->json($containerList);
    }

    /**
     * @Route("/container/{id}", name="app_container_id")
     */

    public function UniqueContainer($id, Request $request): Response
    {
        switch ($id) {
            case 'new' :
                $manager = $this->getDoctrine()->getManager();
                if (!$manager->getRepository(ContainerModel::class)->findOneBy(['id' => $request->query->getInt('model')]))
                    return new Response('Aucun model avec cet id : ' . $id);
                if (!$manager->getRepository(ContainerShip::class)->findOneBy(['id' => $request->query->getInt('ship')]))
                    return new Response('Aucun ship avec cet id : ' . $id);

                $ship = $manager->getRepository(ContainerShip::class)->findOneBy(['id' => $request->query->getInt('ship')]);
                $nb = 0;
                $nombre = $manager->getRepository(Container::class)->findBy(['containership_id' => $request->query->getInt('ship')]);
                foreach ($nombre as $key) {
                    $nb++;
                }
                if ($ship->getContainerLimit() > $nb + 1) {
                    $container = new Container();
                    $container->setColor($request->query->get('color'));
                    $container->setContainerModelId($request->query->get('model'));
                    $container->setContainershipId($request->query->get('ship'));

                    $manager->persist($container);
                    $manager->flush();
                    return new Response('Container ajouté');
                } else {
                    return new Response('Le ship ' . $ship->getName() . 'contient trop de container');
                }
            default:
                if ($id < 3) {
                    return $this->json(['aucune valeur']);
                }
                $manager = $this->getDoctrine()->getManager();
                $container = $manager->getRepository(Container::class)->findOneBy(['id' => $id]);
        }
    }

    /**
     * @Route("/containership", name="app_containership")
     */
    public function containershipList(): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $containershipList = $manager->getRepository(ContainerShip::class)->findAll();
        return $this->json($containershipList);
    }

    /**
     * @Route("/containership/{id}", name="containership_id")
     */
    public function Uniquecontainership($id, Request $request): Response
    {
        switch ($id) {
            case 'new':
                $shipmanager = $this->getDoctrine()->getManager();
                $ship = new ContainerShip();
                $ship->setName($request->query->get('name'));
                $ship->setCaptainName($request->query->get('captain'));
                $ship->setContainerLimit($request->query->getInt('limit'));
                $shipmanager->persist($ship);
                $shipmanager->flush();

                return new Response('Container créé');

            default :
                if ($id < 3) {
                    return $this->json(['Aucune valeur']);
                }

                $manager = $this->getDoctrine()->getManager();
                $ship = $manager->getRepository(ContainerShip::class)->findOneBy(['id' => $id]);

                return $this->json(ship);
        }
    }

    /**
     * @Route("/product", name="app_product")
     */
    public function productList(): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $productList = $manager->getRepository(ContainerShip::class)->findAll();
        return $this->json($productList);

    }

    /**
     * @Route("/product/{id}", name="app_product_id")
     */
    public function Uniqueproduct($id, Request $request): Response
    {
        switch ($id) {
            case 'new':
                $manager = $this->getDoctrine()->getManager();

                $product = new Product();
                $product->setName($request->query->get('name'));
                $product->setHeight($request->query->get('height'));
                $product->setLength($request->query->get('length'));
                $product->setWidth($request->query->get('width'));

                $manager->persist($product);
                $manager->flush();

                return new Response('Produit créé');

            default :
                $manager = $this->getDoctrine()->getManager();
                $product = $manager->getRepository(Product::class)->findOneBy(['id' => $id]);

                return $this->json($product);
        }
    }

    /**
     * @Route("/product-container/new", name="app_containerproduct_new")
     */
    public function addProduct(Request $request): Response{

        $manager = $this->getDoctrine()->getManager();

        if(!$manager->getRepository(Container::class)->findOneBy(['id' => $request->query->getInt('container')]))
            return new Response('Pas de conainter');

        if(!$manager->getRepository(Product::class)->findOneBy(['id' => $request->query->getInt('product')]))
            return new Response('Pas de produit');





}




}