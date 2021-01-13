<?php

namespace App\Controller;

use App\Entity\CONTAINER;
use App\Entity\CONTAINERMODEL;
use App\Entity\CONTAINERPRODUCT;
use App\Entity\PRODUCT;

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
        $containerProduct = new CONTAINERPRODUCT();

        $container = $manager->getRepository(CONTAINER::class)
            ->findOneBy(['id' => $_POST['container_id']]);

        if (isset($container)) {
            $containerModel = $manager->getRepository(CONTAINERMODEL::class)
                ->findOneBy(['id' => $container->getCONTAINERMODELID()]);
        }

        if (isset($containerModel)) {
            $containerVolume = $containerModel->getLENGHT() * $containerModel->getWIDTH() * $containerModel->getHEIGHT();
        }

        $containerProductList = $manager->getRepository(CONTAINERPRODUCT::class)
            ->findBy(['container_id' => $_POST['container_id']]);

        $actualVolume = 0;
        foreach ($containerProductList as $item) {
            $product = $manager->getRepository(PRODUCT::class)
                ->findOneBy(['id' => $item->getPRODUCTID()]);

            if (isset($product)) {
                $actualVolume += $product->getLENGHT() * $product->getWIDTH() * $product->getHEIGHT() * $item->getQUANTITY();
            }
        }

        $newProduct = $manager->getRepository(PRODUCT::class)
            ->findOneBy(['id' => $_POST['product_id']]);
        if (isset($newProduct)) {
            $volumeToAdd = $newProduct->getLENGHT() * $newProduct->getWIDTH() * $newProduct->getHEIGHT() * $_POST['quantity'];
        }

        if (isset($volumeToAdd, $containerVolume)) {
            if ($actualVolume + $volumeToAdd <= $containerVolume) {

                if(isset($_POST['container_id'])) {
                    $containerProduct->setCONTAINERID($_POST['container_id']);
                }

                if (isset($_POST['product_id'])) {
                    $containerProduct->setPRODUCTID($_POST['product_id']);
                }

                if( isset($_POST['quantity'])){
                    $containerProduct->setQUANTITY($_POST['quantity']);
                }

                $manager->persist($containerProduct);
                $manager->flush();

            } else {
                $containerProduct = 'Impossible de mettre le produit dans le container.';
            }
        }

        return $this->json($containerProduct);
    }
}