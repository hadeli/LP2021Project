<?php


namespace App\Controller;


use App\Entity\Container;
use App\Entity\ContainerModel;
use App\Entity\Containership;
use http\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContainerController
 * @package App\Controller
 *
 */

class ContainerController extends AbstractController
{

    /**
     * @Route("/container", name="getAllContainer" , methods={"GET"})
     *
     */
    public function getAllContainer(){

        return $this->json($this->getDoctrine()->getRepository(Container::class)->findAll());

    }


    /**
     * @Route("/container/{id}", name="getContainerById",methods={"GET"})
     * @param int $id
     * @return JsonResponse
     */
    public function getContainerById(int $id){

        return $this->json($this->getDoctrine()->getRepository(Container::class)->find($id));

    }

    /**
     * @Route("/container/new",name="addContainer",methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function addContainer(Request $request){


        $model = $request->query->get('model');
        try{
            $modelObject =  $this->getDoctrine()->getRepository(ContainerModel::class)->find($model);
        }catch (Exception $e){
            return new Response("Ce modéle n'existe pas");
        }

        $ship = $request->query->get('ship');
        try{
            $shipObject = $this->getDoctrine()->getRepository(Containership::class)->find($ship);
        }catch (Exception $e){
            return new Response("Ce bateau n'existe pas");
        }

        $inside = $this->getDoctrine()->getRepository(Container::class)->countInside($ship);

        if ($inside >= $shipObject->getContainerLimit()){
            return new Response("Ce bateau est plein");
        }

        $entityManager = $this->getDoctrine()->getManager();

        $container = new Container();
        $container->setColor($request->query->get('color'));
        $container->setContainerModel($modelObject);
        $container->setContainership($shipObject);

        $entityManager->persist($container);
        $entityManager->flush();

        return new Response('Conteneur ajouté a l\'id '.$container->getId());
    }


}