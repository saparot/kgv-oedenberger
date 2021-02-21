<?php

namespace App\Controller\News;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    /**
     * @Route("/news", name="newsList")
     */
    public function index(): Response
    {
        return $this->render('news/list/index.html.twig', [
            'controller_name' => 'ListController',
        ]);
    }
}
