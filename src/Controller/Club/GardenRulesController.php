<?php

namespace App\Controller\Club;

use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\PageviewMixin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GardenRulesController extends AbstractController {

    use  BreadCrumbMixin, PageviewMixin;

    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getKgvUrls (): ?KgvUrls {
        return $this->kgvUrls;
    }

    function getCategory (): ?string {
        return Categories::CATEGORY_CLUB;
    }

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addAboutUs(null, $this->generateUrl('clubGardenRules'));
    }

    function getPageTitle (): ?string {
        return 'Gartenordnung';
    }

    protected function getIntroData (): ?array {
        return [
            'title' => 'Gartenordnung',
            'icon' => 'plant-pot',
            'text' => 'Die hier abgebildete Garten Ordnung ist eine Abschrift des Stadtverbandes der Kleingärten in Nürnberg e.V. Bitte beachten Sie, dass immer nur die aktuelle Ordnung verbindlich ist. Wir sind stets bemüht die Version auf dieser Seite für Sie aktuell zu halten.',
        ];
    }

    function getTemplate (): string {
        return 'club/garden_rules/index.twig';
    }

    /**
     * @Route("/verein/gartenordnung", name="clubGardenRules")
     * @param Request $request
     *
     * @return Response
     */
    function index (Request $request): Response {
        return $this->renderPageView();
    }
}
