<?php

namespace App\Controller\Club;

use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\PageviewMixin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PenaltyOrderController extends AbstractController
{

    use  BreadCrumbMixin, PageviewMixin;

    #[Route('/penalty/order', name: 'penalty_order')]
    public function index(): Response
    {
        return $this->renderPageView();

    }


    use  BreadCrumbMixin, PageviewMixin;

    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getKgvUrls (): ?KgvUrls {
        return $this->kgvUrls;
    }

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addHome('Ordnungsgeldverordnung', null);
    }

    function getPageTitle (): ?string {
        return 'Ordnungsgeldverordnung';
    }

    function getCategory (): ?string {
        return Categories::CATEGORY_ESSENTIALS;
    }

    function getTemplate (): string {
        return 'club/penalty_order/index.twig';
    }

    function getIntroData (): ?array {
        return null;
    }
}
