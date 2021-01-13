<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerModel;
use App\Entity\ContainerProduct;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductContainerController
 * @package App\Controller
 */
class ProductContainerController extends AbstractController
{
    /**
     * @Route("/productcontainer/new", name="product_container", methods={"POST"})
     */
    public function specificProductContainer() : Response {

        $manager = $this->getDoctrine()->getManager();
        $containerProduct = new ContainerProduct();

        $container = $manager->getRepository(Container::class)
            ->findOneBy(['id' => $_POST['container_id']]);

        if (isset($container)) {
            $containerModel = $manager->getRepository(ContainerModel::class)
                ->findOneBy(['id' => $container->getContainerModelId()]);
        }

        if (isset($containerModel)) {
            $containerVolume = $containerModel->getLength() * $containerModel->getWidth() * $containerModel->getHeight();
        }

        $containerProductList = $manager->getRepository(ContainerProduct::class)
            ->findBy(['container_id' => $_POST['container_id']]);

        $actualVolume = 0;
        foreach ($containerProductList as $item) {
            $product = $manager->getRepository(Product::class)
                ->findOneBy(['id' => $item->getProductId()]);

            if (isset($product)) {
                $actualVolume += $product->getLength() * $product->getWidth() * $product->getHeight() * $item->getQuantity();
            }
        }

        $newProduct = $manager->getRepository(Product::class)
            ->findOneBy(['id' => $_POST['product_id']]);
        if (isset($newProduct)) {
            $volumeToAdd = $newProduct->getLength() * $newProduct->getWidth() * $newProduct->getHeight() * $_POST['quantity'];
        }

        if (isset($volumeToAdd, $containerVolume)) {
            if ($actualVolume + $volumeToAdd <= $containerVolume) {

                if(isset($_POST['container_id'])) {
                    $containerProduct->setContainerId($_POST['container_id']);
                }

                if (isset($_POST['product_id'])) {
                    $containerProduct->setProductId($_POST['product_id']);
                }

                if( isset($_POST['quantity'])){
                    $containerProduct->setQuantity($_POST['quantity']);
                }

                $manager->persist($containerProduct);
                $manager->flush();

            } else {
                $containerProduct = 'Impossible de mettre produit dans le container.';
            }
        }

        return $this->json($containerProduct);
    }
}