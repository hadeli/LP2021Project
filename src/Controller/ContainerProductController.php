<?php


namespace App\Controller;

use App\Entity\Container;
use App\Entity\ContainerModel;
use App\Entity\ContainerProduct;
use App\Entity\Product;
use http\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContainerProductController
 * @package App\Controller
 *
 */
class ContainerProductController extends  AbstractController
{

    /**
     * @Route("/containerProduct/new",name="addContainerProduct",methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function addContainerProduct(Request $request){

        $quantity = $request->query->get('quantity');

        if ($quantity == 0){
            return new Response('Quantité a zéro');
        }


        $product = $request->query->get('product');

        try{
            $productObject = $this->getDoctrine()->getRepository(Product::class)->find($product);
        }catch (Exception $e){
            return new Response('Produit introuvable');
        }
        $productVolume = $this->getDoctrine()->getRepository(Product::class)->getVolume($product)*$quantity;

        try{
            $container = $this->getDoctrine()->getRepository(Container::class)->find($request->query->get('container'));
        }catch (Exception $e){
            return new Response('Conteneur introuvable');
        }
        $containerVolume = $this->getDoctrine()->getRepository(ContainerModel::class)->getVolume($container->getContainerModel()->getId());

        $productInsides = $this->getDoctrine()->getRepository(ContainerProduct::class)->findBy(['container' => $request->query->get('container')]);
        $used = 0;
        foreach ($productInsides as $productInside){
            $used += (int)$this->getDoctrine()->getRepository(Product::class)->getVolume($productInside->getProduct()->getId())*(int)$productInside->getQuantity();
        }
        $availible = $containerVolume - $used;


        if ($availible > $productVolume){

            $entityManager = $this->getDoctrine()->getManager();

            $cProd = new ContainerProduct();
            $cProd->setContainer($container);
            $cProd->setProduct($productObject);
            $cProd->setQuantity($quantity);

            $entityManager->persist($cProd);
            $entityManager->flush();

            return new Response('produit ajouté');
        }else{
            return new Response('plus de place dans le conteneur');
        }

    }

}