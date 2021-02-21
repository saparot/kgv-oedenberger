<?php

namespace App\Controller\GardenArea;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RouteDescriptionController extends AbstractController
{
    /**
     * @Route("/gardenArea/route-description", name="gardenAreaRouteDescription")
     */
    public function index(): Response
    {
        return $this->render('garden_area/route_description/index.html.twig', [
            'controller_name' => 'RouteDescriptionController',
        ]);
    }
}
