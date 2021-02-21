<?php

namespace App\Controller\GardenArea;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FactsController extends AbstractController {

    /**
     * @Route("/gardenArea/facts", name="gardenAreaFacts")
     */
    public function index (): Response {
        return $this->render('garden_area/facts/index.html.twig', [
            'controller_name' => 'FactsController',
        ]);
    }
}
