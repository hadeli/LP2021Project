<?php

namespace App\Controller;

//use Exception;
use App\Entity\CONTAINERSHIP;
use App\Normalizer\CONTAINERSHIPNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContainershipController extends AbstractController
{
    /**
     * @Route("/containership", name="containerShipList")
     */
    public function getContainerShipList(): Response
    {
        return $this->json($this->getDoctrine()->getRepository(CONTAINERSHIP::class)->findAll());
    }
    
    /**
     * @Route("/containership/new", name="newContainerShip", methods={"POST"})
     */
    public function createContainerShip(Request $req): Response
    {
        $needed_keys = ["NAME", "CAPTAIN_NAME", "CONTAINER_LIMIT"];
        foreach($needed_keys as $key){
            if ($req->request->get($key) === null){
                return $this->json([
                    'status' => 'ERROR',
                    'code' => 1,
                    'message' => $key . " key is missing"
                ]);
            }
        }

        $new = new CONTAINERSHIP();
        $new->setNAME($req->request->get("NAME"));
        $new->setCAPTAINNAME($req->request->get("CAPTAIN_NAME"));
        $new->setCONTAINERLIMIT($req->request->get("CONTAINER_LIMIT"));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($new);
        $entityManager->flush();

        $norm = new CONTAINERSHIPNormalizer();
        return $this->json([
            'status' => 'OK',
            'code' => 0, 
            'result' => $norm->normalize($new)
        ]);
    }

    /**
     * @Route("/containership/{id}", name="containerShip")
     */
    public function getSpecificContainerShip($id): Response
    {
        return $this->json($this->getDoctrine()->getRepository(CONTAINERSHIP::class)->find($id));
    }
}
