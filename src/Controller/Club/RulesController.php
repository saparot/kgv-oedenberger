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

class RulesController extends AbstractController {

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
        return $this->addAboutUs(null, $this->generateUrl('clubRules'));
    }

    function getPageTitle (): ?string {
        return 'Satzung';
    }

    function getTemplate (): string {
        return 'club/rules/index.html.twig';
    }

    private function getIntroData (): ?array {
        return [
            'title' => 'Satzung',
            'icon' => 'shovel',
            'text' => 'Jeder Verein braucht eine Satzung. In dieser wird festgelegt und beschrieben wie unser Verein aufgestellt ist und wie er funktioniert. Die nicht allzu lange ist dem interessierten Leser empfohlen.'
        ];
    }

    /**
     * @Route("/club/rules", name="clubRules")
     * @param Request $request
     *
     * @return Response
     */
    function index (Request $request): Response {
        return $this->renderPageView();
    }
}
