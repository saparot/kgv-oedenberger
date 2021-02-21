<?php

namespace App\Controller\GardenArea;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlaygroundController extends AbstractController {

    /**
     * @Route("/gardenArea/playground", name="gardenAreaPlayground")
     */
    public function index (): Response {
        return $this->render('garden_area/playground/index.html.twig', [
            'controller_name' => 'PlaygroundController',
        ]);
    }
}
