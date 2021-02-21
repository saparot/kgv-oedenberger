<?php

namespace App\Controller\Club;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExecutivesController extends AbstractController {

    /**
     * @Route("/club/executives", name="clubExecutives")
     */
    public function index (): Response {
        return $this->render('club/executives/index.html.twig', [
            'controller_name' => 'ExecutivesController',
        ]);
    }
}
