<?php

namespace App\Controller\Garden;

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

class GardenTerminationController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getKgvUrls (): ?KgvUrls {
        return $this->kgvUrls;
    }

    function getCategory (): ?string {
        return Categories::CATEGORY_GARDEN;
    }

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addGardenArea('Gartenauflösung', null);
    }

    function getPageTitle (): ?string {
        return 'Gartenauflösung';
    }

    function getTemplate (): string {
        return 'garden/gardenTermination/index.twig';
    }

    protected function getIntroData (): ?array {
        return [
            'title' => 'Gartenauflösung',
            'icon' => 'wheel-barrow-colored',
            'text' => 'Dem einen fällt es schwer, dem anderen leicht. Wenn der Zeitpunkt gekommen ist, an dem man seinen Garten aufgeben möchte oder muss, gibt es natürlich auch einige Dinge zu beachten. ',
        ];
    }

    /**
     * @Route("/mein-garten/aufloesung", name="gardenTermination")
     * @param Request $request
     *
     * @return Response
     */
    public function index (Request $request): Response {
        return $this->renderPageView();
    }
}
