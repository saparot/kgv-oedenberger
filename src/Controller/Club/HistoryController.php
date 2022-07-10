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

class HistoryController extends AbstractController {

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
        return $this->addAboutUs(null, $this->generateUrl('clubHistory'));
    }

    function getPageTitle (): ?string {
        return 'Vereinsgeschichte';
    }

    function getTemplate (): string {
        return 'club/history/index.twig';
    }

    protected function getIntroData (): ?array {
        return [
            'title' => 'Vereinsgeschichte',
            'icon' => 'fruit-tree',
            'text' => 'Unser Verein besteht bereits sein 1919. Wichtige Meilensteine und Ereignisse haben wir auf dieser Seite zusammenfasst.',
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
