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

class GardenDesignNotAllowedController extends AbstractController {

    use LinkListMixin, BreadCrumbMixin, PageviewMixin;

    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getKgvUrls (): ?KgvUrls {
        return null;
    }

    function getCategory (): ?string {
        return Categories::CATEGORY_GARDEN;
    }

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addGarden('Was nicht in den Garten darf', $this->generateUrl('gardenGardenDesign'));
    }

    function getPageTitle (): ?string {
        return 'Was nicht in den Garten darf';
    }

    function getTemplate (): string {
        return 'garden/designNotAllowed/index.twig';
    }

    protected function getIntroData (): ?array {
        return [
            'title' => 'Was nicht in den Garten darf',
            'icon' => 'tree-colored',
            'text' => 'Hier haben wir Ihnen ein paar Informationen zusammengestellt, was nicht in den Garten darf. Bei Fragen oder Unklarheiten steht Ihnen der Vorstand und die Fachberatung gerne zur Verfügung.',
        ];
    }

    /**
     * @Route("/mein-garten/garten-gestaltung-was-nicht-geht", name="gardenGardenDesignNotAllowed")
     */
    public function index (): Response {
        return $this->renderPageView();
    }
}
