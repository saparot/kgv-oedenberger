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

class OverviewController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

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
        return $this->addGardenArea(null, $this->generateUrl('gardenAreaOverview'));
    }

    function getPageTitle (): ?string {
        return 'für Statistiker';
    }

    function getTemplate (): string {
        return 'garden_area/overview/index.twig';
    }

    protected function getIntroData (): ?array {
        return [
            'title' => 'Die Anlage in Zahlen',
            'icon' => 'flower-with-pot-colored',
            'text' => "Für Statistiker und solche die es genau wissen wollen, gibt es auch ein paar Zahlen rund um unseren Kleingartenverein und die Anlage :)",
        ];
    }

    /**
     * @Route("/anlage/uebersicht", name="gardenAreaOverview")
     * @return Response
     */
    function index (): Response {
        $this->assign('facts', $this->getFacts());

        return $this->renderPageView();
    }

    private function getFacts (): array {
        return [
            [
                'fact' => '165 Gärten',
                'text' => '..sind in unserem Kleingartenverein beheimatet',
            ],
            [
                'fact' => '57.018 m²',
                'text' => '..Fläche beansprucht unsere Anlage',
            ],
            [
                'fact' => '0,03 %',
                'text' => 'ist der Prozentuale Flächenanteil an Nürnberg (<a href="https://de.wikipedia.org/wiki/N%C3%BCrnberg" target="_new">Stand 05/2021</a>) die vielleicht schönsten 0,03% von Nürnberg ;)',
            ],
        ];
    }
}
