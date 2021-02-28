<?php

namespace App\Controller\GardenArea;

use App\Helper\BreadCrumbsChain;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\LinkListMixin;
use App\Mixin\PageviewMixin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FactsController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addGardenArea(null, $this->generateUrl('gardenAreaFacts'));
    }

    function getPageTitle (): ?string {
        return 'für Statistiker';
    }

    function getTemplate (): string {
        return 'garden_area/facts/index.html.twig';
    }

    /**
     * @Route("/gardenArea/facts", name="gardenAreaFacts")
     * @param Request $request
     *
     * @return Response
     */
    function index (Request $request): Response {
        return $this->renderPageView();
    }
}
