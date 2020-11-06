<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerModel;
use App\Entity\ContainerProduct;
use App\Entity\ContainerShip;
use App\Entity\Product;
use App\Repository\ContainerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function containerUnique($id, Request $request): Response
    {

        switch ($id) {
            case 'new' :
                $manager = $this->getDoctrine()->getManager();
                if (!$manager->getRepository(ContainerShip::class)->findOneBy(['id' => $request->query->getInt('ship')]))
                    return new Response('Ship non trouvé !!!');
                if (!$manager->getRepository(ContainerModel::class)->findOneBy(['id' => $request->query->getInt('model')]))
                    return new Response('Model non trouvé !!!');

                $ship = $manager->getRepository(ContainerShip::class)->findOneBy(['id' => $request->query->getInt('ship')]);
                $nb=0;
                $nombre = $manager->getRepository(Container::class)->findBy(['containership_id' => $request->query->getInt('ship')]);
                foreach ($nombre as $key){
                    $nb++;
                }
                if ($ship->getContainerLimit() > $nb+1) {
                    $container = new Container();
                    $container->setColor($request->query->get('color'));
                    $container->setContainerModelId($request->query->getInt('model'));
                    $container->setContainershipId($request->query->getInt('ship'));

                    $manager->persist($container);
                    $manager->flush();

                    return new Response("Container ajouté !!!");
                }else{
                    return new Response("Trops de Container sur le ship ".$ship->getName());
                }

            default:
                if ($id < 3) {
                    return $this->json(['pas de valeur']);
                }
                $manager = $this->getDoctrine()->getManager();
                $container = $manager->getRepository(Container::class)->findOneBy(['id' => $id]);

                return $this->json($container);
        }
    }

    /**
     * @Route("/containership", name="app_containership")
     */
    public function shipList(): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $shipList = $manager->getRepository(ContainerShip::class)->findAll();

        return $this->json($shipList);
    }

    /**
     * @Route("/containership/{id}", name="app_containership_id")
     */
    public function shipUnique($id ,Request $request): Response
    {
        switch ($id){
            case 'new' :

                $shipmanager = $this->getDoctrine()->getManager();

                $ship = new ContainerShip();
                $ship->setName($request->query->get('name'));
                $ship->setCaptainName($request->query->get('captain'));
                $ship->setContainerLimit($request->query->getInt('limit'));

                $shipmanager->persist($ship);
                $shipmanager->flush();

                return new Response('Containership bien créé !!!');

            default :

                if( $id < 3){
                return $this->json(['pas de valeur']);
        }
            $manager = $this->getDoctrine()->getManager();
            $ship = $manager->getRepository(ContainerShip::class)->findOneBy(['id' => $id]);

            return $this->json($ship);
        }

    }
    /**
     * @Route("/product", name="app_container")
     */
    public function productList(): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $productList = $manager->getRepository(Product::class)->findAll();

        return $this->json($productList);
    }

    /**
     * @Route("/product/{id}", name="app_product_id")
     */
    public function productUnique($id, Request $request): Response
    {
        switch ($id){
            case 'new' :

                $manager = $this->getDoctrine()->getManager();


                $product = new Product();
                $product->setName($request->query->get('name'));
                $product->setHeight($request->query->getInt('height'));
                $product->setWidth($request->query->getInt('width'));
                $product->setLength($request->query->getInt('length'));

                $manager->persist($product);
                $manager->flush();

                return new Response('Product bien créé !!!');



            default :

                $manager = $this->getDoctrine()->getManager();
                $product = $manager->getRepository(Product::class)->findOneBy(['id' => $id]);

                return $this->json($product);
        }

    }

    /**
     * @Route("/product-container/new", name="app_containerproduct_new")
     */
    public function addProductInContainer(Request $request): Response
    {
        $manager = $this->getDoctrine()->getManager();

        if (!$manager->getRepository(Container::class)->findOneBy(['id' => $request->query->getInt('container')]))
            return new Response('container non trouvé !!!');
        if (!$manager->getRepository(Product::class)->findOneBy(['id' => $request->query->getInt('product')]))
            return new Response('product non trouvé !!!');

        $container = $manager->getRepository(Container::class)->findOneBy(['id' => $request->query->getInt('container')]);
        $model = $manager->getRepository(ContainerModel::class)->findOneBy(['id' => $container->getContainerModelId()]);
        $container_product = $manager->getRepository(ContainerProduct::class)->findBy(['container_id' => $request->query->getInt('container')]);

        $espace_container=$model->getHeight()*$model->getWidth()*$model->getLength();
        $espace_content=0;
        $espace_product = $manager->getRepository(Product::class)->findOneBy(['id' => $request->query->getInt('product')]);
        $taille_product = $espace_product->getHeight()*$espace_product->getWidth()*$espace_product->getLength()*$request->query->getInt('quantity');

        foreach ($container_product as $key){
            $product = $manager->getRepository(Product::class)->findOneBy(['id' => $key->getProductId()]);
            $espace_content = $espace_content + ($product->getHeight()*$product->getWidth()*$product->getLength())*$key->getQuantityId();
        }
        if ($espace_container >= $espace_content+$taille_product) {

            $product = new ContainerProduct();
            $product->setContainerId($request->query->getInt('container'));
            $product->setProductId($request->query->getInt('product'));
            $product->setQuantityId($request->query->getInt('quantity'));

            $manager->persist($product);
            $manager->flush();

            return new Response("Produit ajouté !!!");
        }else{
            return new Response('Container trops plein !!!');
        }
    }

}