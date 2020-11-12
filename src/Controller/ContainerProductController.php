<?php

namespace App\Controller;

use App\Entity\CONTAINERPRODUCT;
use App\Entity\PRODUCT;
use App\Normalizer\CONTAINERPRODUCTNormalizer;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainerProductController extends AbstractController
{
    /**
     * @Route("/container-product", name="containerProductList")
     */
    public function getProductList(): Response
    {
        return $this->json($this->getDoctrine()->getRepository(PRODUCT::class)->findAll());
    }

    /**
     * @Route("/container-product/new", name="newContainerProduct", methods={"POST"})
     */
    public function createContrainerProduct(Request $req): Response
    {
        // Check for keys existances
        $needed_keys = ["CONTAINER_ID", "PRODUCT_ID", "QUANTITY"];
        foreach($needed_keys as $key){
            if ($req->request->get($key) == null){
                return $this->json([
                    'status' => 'ERROR',
                    'code' => 1,
                    'message' => $key . " key is missing"
                ]);
            }
        }

        $remainingReq = $this->getDoctrine()->getRepository(CONTAINERPRODUCT::class)->getRemainingSpace($req->request->get("CONTAINER_ID"));
        $productVolumeReq = $this->getDoctrine()->getRepository(PRODUCT::class)->getProductVolume($req->request->get("PRODUCT_ID"));
        try
        {
            $remaining = intval($remainingReq[0]["remaining"]);
            $productVolume = intval($productVolumeReq[0]["volume"]);
            $quantity = intval($req->request->get("QUANTITY"));
        }
        catch (Exception $e)
        {
            return $this->json([
                'status' => 'ERROR',
                'code' => 2,
                'result' => 'The SQL Query cannot be performed (please check your informations)'
            ]);
        }
        
        if ($quantity*$productVolume > $remaining)
        {
            return $this->json([
                'status' => 'ERROR',
                'code' => 4,
                'message' => "Need more space to add this product"
            ]);
        }
        
        // Creation of the new CONTAINERPRODUCT
        $new = new CONTAINERPRODUCT();
        $new->setCONTAINERID($req->request->get("CONTAINER_ID"));
        $new->setPRODUCTID($req->request->get("PRODUCT_ID"));
        $new->setQUANTITY($req->request->get("QUANTITY"));
        // Saving of this
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($new);
        $entityManager->flush();
        // Debug : display the created object
        $norm = new CONTAINERPRODUCTNormalizer();
        return $this->json([
            'status' => 'OK',
            'code' => 0,
            'result' => $norm->normalize($new)
        ]);
    }
    
    /**
     * @Route("/container-product/{id}", name="containerProduct")
     */
    public function getSpecificContainerProduct($id): Response
    {
        return $this->json($this->getDoctrine()->getRepository(CONTAINERPRODUCT::class)->find($id));
    }
}
