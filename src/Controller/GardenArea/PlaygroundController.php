<?php

namespace App\Controller\GardenArea;

use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\LinkListMixin;
use App\Mixin\PageviewMixin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlaygroundController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    /**
     * @var KgvUrls
     */
    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getCategory (): ?string {
        return Categories::CATEGORY_AREA;
    }

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addGardenArea('Spielplatz', $this->generateUrl('gardenAreaPlayground'));
    }

    function getPageTitle (): ?string {
        return 'Spielplatz';
    }

    function getTemplate (): string {
        return 'garden_area/playground/index.html.twig';
    }

    private function getIntroData (): ?array {
        return [
            'title' => 'Spielplatz',
            'icon' => 'bug',
            'text' => "Der kleine Spielplatz der Kleingartenkolonie befindet sich direkt neben dem Vereinsheim. Verfehlen können Sie diesen nicht, wenn Sie den Hauptweg zur Gaststätte hinaufgehen und direkt an der Gaststätte links abbiegen. Der Spielplatz existiert bereits seit den 70ern Jahren. Hier können sich Ihre Kinder an Schaukeln und Wippgeräten austoben oder im Sandkasten ihrer Fantasie freien Lauf lassen.",
        ];
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
