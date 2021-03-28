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

class WalkThroughController extends AbstractController {

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
        return $this->addGardenArea('Spaziergang', $this->generateUrl('gardenAreaWalkThrough'));
    }

    function getPageTitle (): ?string {
        return 'Spaziergang';
    }

    function getTemplate (): string {
        return 'garden_area/walk_through/index.html.twig';
    }

    /**
     * @Route("/gardenArea/walk-through", name="gardenAreaWalkThrough")
     * @param Request $request
     *
     * @return Response
     */
    function index (Request $request): Response {
        return $this->renderPageView();
    }
}
