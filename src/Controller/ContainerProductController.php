<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerModel;
use App\Entity\ContainerProduct;
use App\Entity\Containership;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerProductController extends AbstractController
{
    /**
     * @Route("/product-container/new", name="app_productContainer_new", methods={"POST"})
     */
    public function productContainerNew(): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $request = Request::createFromGlobals();
        $containerProduct = new ContainerProduct();

        $container = $manager->getRepository(Container::class)
            ->findOneBy(['id' => $_POST['containerId']]);

        $containerModel = $manager->getRepository(ContainerModel::class)
            ->findOneBy(['id' => $container->getContainerModelId()]);

        $containerVolume = $containerModel->getLength() * $containerModel->getWidth() * $containerModel->getHeight();

        $containerProductList = $manager->getRepository(ContainerProduct::class)
            ->findBy(['containerId' => $_POST['containerId']]);

        $actualVolume = 0;
        foreach ($containerProductList as $item) {
            $product = $manager->getRepository(Product::class)
                ->findOneBy(['id' => $item->getProductId()]);

            $actualVolume += $product->getLength() * $product->getWidth() * $product->getHeight() * $item->getQuantity();
        }

        $newProduct = $manager->getRepository(Product::class)
            ->findOneBy(['id' => $_POST['productId']]);
        $volumeToAdd = $newProduct->getLength() * $newProduct->getWidth() * $newProduct->getHeight() * $_POST['quantity'];

        if ($actualVolume + $volumeToAdd <= $containerVolume) {

            if(isset($_POST['containerId'])) {
            $containerProduct->setContainerId($_POST['containerId']);
            }

            if (isset($_POST['productId'])) {
                $containerProduct->setProductId($_POST['productId']);
            }

            if( isset($_POST['quantity'])){
                $containerProduct->setQuantity($_POST['quantity']);
            }

            $manager->persist($containerProduct);
            $manager->flush();

        } else {
            $containerProduct = [
              'erreur' => 'Soit vous esseillez de mettre trop de produis soit le conteneur est deja plein'
            ];
        }

        return $this->json($containerProduct);
    }
}
