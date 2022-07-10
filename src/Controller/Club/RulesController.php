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

class RulesController extends AbstractController {

    use BreadCrumbMixin, PageviewMixin;

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
        return $this->addAboutUs(null, $this->generateUrl('clubRules'));
    }

    function getPageTitle (): ?string {
        return 'Satzung';
    }

    function getTemplate (): string {
        return 'club/rules/index.twig';
    }

    protected function getIntroData (): ?array {
        return [
            'title' => 'Satzung',
            'icon' => 'shovel-colored',
            'text' => 'Jeder Verein braucht eine Satzung. In dieser wird festgelegt und beschrieben wie unser Verein aufgestellt ist und wie er funktioniert. Die nicht allzu lange Lektüre ist dem interessierten Leser empfohlen.',
        ];
    }

    /**
     * @Route("/verein/satzung", name="clubRules")
     * @param Request $request
     *
     * @return Response
     */
    function index (Request $request): Response {
        return $this->renderPageView();
    }
}
