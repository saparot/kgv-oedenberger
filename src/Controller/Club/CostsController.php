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

class CostsController extends AbstractController {

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
        return $this->addAboutUs(null, $this->generateUrl('clubCosts'));
    }

    function getPageTitle (): ?string {
        return 'Kosten';
    }

    function getTemplate (): string {
        return 'club/costs/index.twig';
    }

    protected function getIntroData (): ?array {
        return [
            'title' => 'Was kostet ein Kleingarten?',
            'icon' => 'shovel-colored',
            'text' => 'Hier finden Sie einen Überblick über die zu erwartenden Kosten, wenn Sie einen Kleingarten pachten.',
        ];
    }

    /**
     * @Route("/verein/kosten", name="clubCosts")
     * @param Request $request
     *
     * @return Response
     */
    function index (Request $request): Response {
        return $this->renderPageView();
    }
}
