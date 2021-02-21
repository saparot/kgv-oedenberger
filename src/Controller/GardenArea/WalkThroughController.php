<?php

namespace App\Controller\GardenArea;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WalkThroughController extends AbstractController {

    /**
     * @Route("/gardenArea/walk-through", name="gardenAreaWalkThrough")
     */
    public function index (): Response {
        return $this->render('garden_area/walk_through/index.html.twig', [
            'controller_name' => 'WalkThroughController',
        ]);
    }
}
