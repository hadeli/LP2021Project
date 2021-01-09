<?php

namespace App\Controller;

use Exception;
use App\Entity\CONTAINER;
use App\Entity\CONTAINERSHIP;
use App\Normalizer\CONTAINERNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CONTAINERController extends AbstractController
{
    /**
     * @Route("/container", name="containerList")
     */
    public function getContainerList(): Response
    {
        return $this->json($this->getDoctrine()->getRepository(CONTAINER::class)->findAll());
    }

    /**
     * @Route("/container/new", name="newContainer", methods={"POST"})
     */
    public function createContainer(Request $req): Response
    {
        $needed_keys = ["COLOR", "CONTAINER_MODEL_ID", "CONTAINERSHIP_ID"];
        foreach($needed_keys as $key){
            if ($req->request->get($key) == null){
                return $this->json([
                    'status' => 'ERROR',
                    'code'=> 1,
                    'message' => $key . " key is missing"
                ]);
            }
        }

        // Stored <=> ships already stored on the containership
        // Limit  <=> how many ships it can hold at all
        // if (stored+1) is above the limit : then stop !
        $reqStored = $this->getDoctrine()->getRepository(CONTAINER::class)->checkForSpace($req->request->get("CONTAINERSHIP_ID"));
        $reqLimit = $this->getDoctrine()->getRepository(CONTAINERSHIP::class)->getLimit($req->request->get("CONTAINERSHIP_ID"));

        try
        {
            $stored = intval($reqStored[0]["c"]);
            $limit = $reqLimit[0]->getCONTAINERLIMIT();
        }
        catch (Exception $e)
        {
            return $this->json([
                'status' => 'ERROR',
                'code'=> 2,
                'result' => 'The SQL Query cannot be performed (please check your informations)'
            ]);
        }

        if ($stored+1 > $limit)
        {
            return $this->json([
                'status' => 'ERROR',
                'code'=> 3,
                'message' => "The target has too many container on it already !"
            ]);
        }

        $new = new CONTAINER();
        $new->setCOLOR($req->request->get("COLOR"));
        $new->setCONTAINERMODELID($req->request->get("CONTAINER_MODEL_ID"));
        $new->setCONTAINERSHIPID($req->request->get("CONTAINERSHIP_ID"));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($new);
        $entityManager->flush();

        $norm = new CONTAINERNormalizer();
        return $this->json([
            'status' => 'OK',
            'code' => 0,
            'result' => $norm->normalize($new)
        ]);
    }

    /**
     * @Route("/container/{id}", name="container")
     */
    public function getSpecificContainer($id): Response
    {
        return $this->json($this->getDoctrine()->getRepository(CONTAINER::class)->find($id));
    }
}