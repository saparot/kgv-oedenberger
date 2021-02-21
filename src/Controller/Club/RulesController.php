<?php

namespace App\Controller\Club;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RulesController extends AbstractController
{
    /**
     * @Route("/club/rules", name="clubRules")
     */
    public function index(): Response
    {
        return $this->render('club/rules/index.html.twig', [
            'controller_name' => 'RulesController',
        ]);
    }
}
