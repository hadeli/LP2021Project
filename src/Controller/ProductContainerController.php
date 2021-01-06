<?php

namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerModel;
use App\Entity\ContainerProduct;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductContainerController extends AbstractController
{
    /**
     * @Route("/product-container/new", name="postContainerProduct",methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function postContainerProduct(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();

        $container = $manager->getRepository(Container::class)
            ->findOneBy(['id' => $_POST['container_id']]);

        $containerModel = $manager->getRepository(ContainerModel::class)
            ->findOneBy(['id' => $container->getContainerModelId()]);

        $containerVolume = $containerModel->getLength() * $containerModel->getWidth() * $containerModel->getHeight();

        $containerProductList = $manager->getRepository(ContainerProduct::class)
            ->findBy(['container_id' => $_POST['container_id']]);

        $volumeActuel = 0;
        foreach ($containerProductList as $unContainerProduct) {
            $product = $manager->getRepository(Product::class)
                ->findOneBy(['id' => $unContainerProduct->getProductId()]);

            $volumeActuel += $product->getLength() * $product->getWidth() * $product->getHeight() * $unContainerProduct->getQuantity();
        }

        $newProduct = $manager->getRepository(Product::class)
            ->findOneBy(['id' => $_POST['product_id']]);
        $volumeToAdd = $newProduct->getLength() * $newProduct->getWidth() * $newProduct->getHeight() * $_POST['quantity'];

        if ($volumeActuel + $volumeToAdd <= $containerVolume) {

            $containerproduct = $this->createFromRequest($request);
            $manager->persist($containerproduct);
            $manager->flush();
        }else {
            $containerproduct = [
                'ereur' => 'Il y a trop de produits ou sinon, le conteneur est déjâ remplis'
            ];
        }
        return $this->json($containerproduct);
    }

    private function createFromRequest(Request $request): ContainerProduct
    {
        return new ContainerProduct($request->get('container_id'),
            $request->get('product_id'),
            $request->get('quantity')
        );
    }
}
