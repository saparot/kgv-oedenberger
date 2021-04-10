<?php

namespace App\Controller\Garden;

use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\LinkListMixin;
use App\Mixin\PageviewMixin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GardenDesignController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    /**
     * @var KgvUrls
     */
    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getCategory (): ?string {
        return Categories::CATEGORY_GARDEN;
    }

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addGarden('Garten Gestaltung', $this->generateUrl('gardenGardenDesign'));
    }

    function getPageTitle (): ?string {
        return 'Garten Gestaltung';
    }

    function getTemplate (): string {
        return 'garden/garden_design/index.html.twig';
    }

    /**
     * @Route("/garden/garden-design", name="gardenGardenDesign")
     */
    public function index (): Response {
        return $this->renderPageView();
    }
}
