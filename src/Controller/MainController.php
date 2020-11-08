<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerProduct;
use App\Entity\ContainerShip;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @Route("/container", name="app_container")
     */
    public function containerList():Response{
        $manager = $this->getDoctrine()->getManager();
        $containerList = $manager->getRepository(Container::class)->findAll();
        return $this->json($containerList);
    }

    /**
     * @Route("/container/{id}", name="app_container_id")
     */
    public function containerId($id):Response{
        if ($id == "new") {
            $request = Request::createFromGlobals();

            if ($request->getMethod() == "POST") {
                $manager = $this->getDoctrine()->getManager();

                $container = new Container();

                if (isset($_POST['color'])) {
                    $container->setColor($_POST['color']);
                }

                if (isset($_POST['containerModelId'])) {
                    $container->setContainerModelId($_POST['containerModelId']);
                }

                if (isset($_POST['containershipId'])) {
                    $container->setContainershipId($_POST['containershipId']);
                }

                $manager->persist($container);
                $manager->flush();

                return new Response("container ajouté");
            }
        }else{
            $manager = $this->getDoctrine()->getManager();
            $containerId = $manager->getRepository(Container::class)->findOneBy(['id'=>$id]);

            if($containerId == NULL){
                $containerId= [
                    'error' => 'Aucun conteneur avec id = ' .$id
                ];
            }
            return $this->json($containerId);
        }
    }

    /**
     * @Route("/containership", name="containership")
     */
    public function containershipList():Response{
        $manager = $this->getDoctrine()->getManager();
        $containershipList = $manager->getRepository(ContainerShip::class)->findAll();
        return $this->json($containershipList);
    }

    /**
     * @Route("/containership/{id}", name="containership_id")
     */
    public function containershipId($id):Response{
        if ($id == "new") {
            $request = Request::createFromGlobals();
            if ($request->getMethod() == "POST") {
                $manager = $this->getDoctrine()->getManager();

                $container = new ContainerShip();

                if (isset($_POST['name'])) {
                    $container->setName($_POST['name']);
                }

                if (isset($_POST['captainName'])) {
                    $container->setCaptainName()($_POST['captainName']);
                }

                if (isset($_POST['containerLimit'])) {
                    $container->setContainerLimit($_POST['containerLimit']);
                }

                $manager->persist($container);
                $manager->flush();

//                return $this->json($container);
                return new Response("containership ajouté");
            }
        }else {
            $manager = $this->getDoctrine()->getManager();
            $containershipId = $manager->getRepository(ContainerShip::class)->findOneBy(['id' => $id]);

            if ($containershipId == NULL) {
                $containershipId = [
                    'error' => 'Aucun containership avec id = ' . $id
                ];
            }

            return $this->json($containershipId);
        }
    }

    /**
     * @Route("/product", name="product")
     */
    public function productList():Response{
        $manager = $this->getDoctrine()->getManager();
        $productList = $manager->getRepository(Product::class)->findAll();
        return $this->json($productList);
    }

    /**
     * @Route("/product/{id}", name="productId")
     */
    public function productId($id):Response
    {
        if ($id == "new") {
            $request = Request::createFromGlobals();
            if ($request->getMethod() == "POST") {

                $manager = $this->getDoctrine()->getManager();

                $container = new Product();

                if (isset($_POST['name'])) {
                    $container->setName($_POST['name']);
                }

                if (isset($_POST['length'])) {
                    $container->setLength($_POST['length']);
                }

                if (isset($_POST['width'])) {
                    $container->setWidth($_POST['width']);
                }

                if (isset($_POST['height'])) {
                    $container->setHeight($_POST['height']);
                }


                $manager->persist($container);
                $manager->flush();

//                return $this->json($container);
                return new Response("produit ajouté");
            }
        } else {
            $manager = $this->getDoctrine()->getManager();
            $productId = $manager->getRepository(Product::class)->findOneBy(['id' => $id]);

            if ($productId == NULL) {
                $productId = [
                    'error' => 'Aucun produit avec id = ' . $id
                ];
            }
            return $this->json($productId);
        }
    }



//    /**
//     * @Route("/container/new", name="app_container_new", methods={"POST"})
//     */
//    public function newContainerShow(): Response{
//
//     }

//    /**
//     * @Route("/product/new", name="app_product_new", methods={"POST"})
//     */
//    public function newProductShow(): Response{
//
//    }


    /**
     * @Route("/containerproduct/new", name="app_containerproduct_new", methods={"POST"})
     */
    public function newContainerproductShow(): Response{
        $request = Request::createFromGlobals();
        if ($request->getMethod() == "POST") {
            $manager = $this->getDoctrine()->getManager();

            $container = new ContainerProduct();

            if (isset($_POST['containerId'])) {
                $container->setContainerId($_POST['containerId']);
            }

            if (isset($_POST['productId'])) {
                $container->setProductId($_POST['productId']);
            }

            if (isset($_POST['quantity'])) {
                $container->setQuantity($_POST['quantity']);
            }

            $manager->persist($container);
            $manager->flush();

            return $this->json($container);
        }
    }

//    /**
//     * @Route("/containership/new", name="app_containerproduct_new", methods={"POST"})
//     */
//    public function newContainership(): Response{
//
//    }


}

