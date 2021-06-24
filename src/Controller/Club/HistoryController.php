<?php

namespace App\Controller\Club;

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

class HistoryController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    /**
     * @var KgvUrls
     */
    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getCategory (): ?string {
        return Categories::CATEGORY_CLUB;
    }

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addAboutUs(null, $this->generateUrl('clubHistory'));
    }

    function getPageTitle (): ?string {
        return 'Vereinsgeschichte';
    }

    function getTemplate (): string {
        return 'club/history/index.html.twig';
    }

    protected function getIntroData (): ?array {
        return [
            'title' => 'Vereinsgeschichte',
            'icon' => 'fruit-tree',
            'text' => 'Auf dieser Seite finden Sie die aktuellen Neuigkeiten rund um den Verein, die Anlage und Gärten, wie z. B. Termine für das An- und Abstellen des Wassers. Besuchen Sie diese Seite regelmäßig um keine Ankündigung zu verpassen!'
        ];
    }

    /**
     * @Route("/verein/geschichte", name="clubHistory")
     * @param Request $request
     *
     * @return Response
     */
    function index (Request $request): Response {
        return $this->renderPageView();
    }
}
