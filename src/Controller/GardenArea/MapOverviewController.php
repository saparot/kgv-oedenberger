<?php

namespace App\Controller\GardenArea;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapOverviewController extends AbstractController {

    /**
     * @Route("/gardenArea/map-overview", name="gardenAreaMapOverview")
     */
    public function index (): Response {
        return $this->render('garden_area/map_overview/index.html.twig', [
            'controller_name' => 'MapOverviewController',
        ]);
    }
}
