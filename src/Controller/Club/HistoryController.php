<?php

namespace App\Controller\Club;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoryController extends AbstractController {

    /**
     * @Route("/club/history", name="clubHistory")
     */
    public function index (): Response {
        return $this->render('club/history/index.html.twig', [
            'controller_name' => 'HistoryController',
        ]);
    }
}
