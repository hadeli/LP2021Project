<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Controller_Main extends AbstractController
{
    /**
     * @Route("/", name="info")
     */
    public function index(ContainerBagInterface $containerBag): Response
    {
        $this->projectRoot = $containerBag->get('kernel.project_dir');
        return new Response(file_get_contents($this->projectRoot."/templates/pageInfos.html"));
    }
}