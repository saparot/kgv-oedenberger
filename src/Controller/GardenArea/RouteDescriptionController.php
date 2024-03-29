<?php

namespace App\Controller\GardenArea;

use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\PageviewMixin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RouteDescriptionController extends AbstractController {

    use BreadCrumbMixin, PageviewMixin;

    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getKgvUrls (): ?KgvUrls {
        return $this->kgvUrls;
    }

    function getCategory (): ?string {
        return Categories::CATEGORY_AREA;
    }

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addGardenArea('Anfahrt', $this->generateUrl('gardenAreaRouteDescription'));
    }

    function getPageTitle (): ?string {
        return 'Anfahrt';
    }

    function getTemplate (): string {
        return 'garden_area/route_description/index.twig';
    }

    protected function getIntroData (): ?array {
        return [
            'title' => 'Lage & Anfahrt',
            'icon' => 'moving-machine-colored',
            'text' => "Die Kleingartenanlage befindet sich im Nord-Osten von Nürnberg und ist direkter Nachbar des Stadtverbandes. Wir haben Google Maps für Sie hier eingebunden, damit Sie ihre Route zu uns direkt planen können. ",
        ];
    }

    /**
     * @Route("/anlage/anfahrt", name="gardenAreaRouteDescription")
     * @return Response
     */
    function index (): Response {
        $this->assign('routeBy', 'google-maps');

        return $this->renderPageView();
    }
}
