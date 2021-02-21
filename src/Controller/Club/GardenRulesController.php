<?php

namespace App\Controller\Club;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GardenRulesController extends AbstractController
{
    /**
     * @Route("/club/garden/rules", name="clubGardenRules")
     */
    public function index(): Response
    {
        return $this->render('club/garden_rules/index.html.twig', [
            'controller_name' => 'GardenRulesController',
        ]);
    }
}
