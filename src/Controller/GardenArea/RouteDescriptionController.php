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

class RouteDescriptionController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addGardenArea('Anfahrt', $this->generateUrl('gardenAreaRouteDescription'));
    }

    function getPageTitle (): ?string {
        return 'Anfahrt';
    }

    function getTemplate (): string {
        return 'garden_area/route_description/index.html.twig';
    }

    /**
     * @Route("/gardenArea/route-description", name="gardenAreaRouteDescription")
     * @param Request $request
     *
     * @return Response
     */
    function index (): Response {
        $this->assign('routeBy', 'google-maps');

        return $this->renderPageView();
    }
}
