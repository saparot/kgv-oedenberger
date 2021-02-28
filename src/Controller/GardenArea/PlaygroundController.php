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

class PlaygroundController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addGardenArea('Spielplatz', $this->generateUrl('gardenAreaPlayground'));
    }

    function getPageTitle (): ?string {
        return 'Spielplatz';
    }

    function getTemplate (): string {
        return 'garden_area/playground/index.html.twig';
    }

    /**
     * @Route("/gardenArea/playground", name="gardenAreaPlayground")
     * @param Request $request
     *
     * @return Response
     */
    function index (Request $request): Response {
        return $this->renderPageView();
    }
}
