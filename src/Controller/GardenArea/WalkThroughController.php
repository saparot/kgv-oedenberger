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

class WalkThroughController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addGardenArea('Spaziergang', $this->generateUrl('gardenAreaWalkThrough'));
    }

    function getPageTitle (): ?string {
        return 'Spaziergang';
    }

    function getTemplate (): string {
        return 'garden_area/walk_through/index.html.twig';
    }

    /**
     * @Route("/gardenArea/walk-through", name="gardenAreaWalkThrough")
     * @param Request $request
     *
     * @return Response
     */
    function index (Request $request): Response {
        return $this->renderPageView();
    }
}
