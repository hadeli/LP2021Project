<?php

namespace App\Controller;
/*
use Exception;
use App\Entity\CONTAINERPRODUCT;
use App\Normalizer\CONTAINERPRODUCTNormalizer;
*/
use App\Entity\PRODUCT;
use App\Normalizer\PRODUCTNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="productList")
     */
    public function getProductList(): Response
    {
        return $this->json($this->getDoctrine()->getRepository(PRODUCT::class)->findAll());
    }
    
    /**
     * @Route("/product/new", name="newProduct", methods={"POST"})
     */
    public function createProduct(Request $req): Response
    {
        // Check for keys existances
        $needed_keys = ["NAME", "LENGTH", "WIDTH", "HEIGHT"];
        foreach($needed_keys as $key){
            if ($req->request->get($key) == null){
                return $this->json([
                    'status' => 'ERROR',
                    'code' => 1,
                    'message' => $key . " key is missing"
                ]);
            }
        }

        // Creation of the new CONTAINERPRODUCT
        $new = new PRODUCT();
        $new->setNAME($req->request->get("NAME"));
        $new->setLENGTH($req->request->get("LENGTH"));
        $new->setWIDTH($req->request->get("WIDTH"));
        $new->setHEIGHT($req->request->get("HEIGHT"));
        // Saving of this
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($new);
        $entityManager->flush();
        // Debug : display the created object
        $norm = new PRODUCTNormalizer();
        return $this->json([
            'status' => 'OK',
            'code' => 0,
            'result' => $norm->normalize($new)
        ]);
    }
    
    /**
     * @Route("/product/{id}", name="product")
     */
    public function getSpecificProduct($id): Response
    {
        return $this->json($this->getDoctrine()->getRepository(PRODUCT::class)->find($id));
    }
}
