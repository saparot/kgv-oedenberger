<?php

namespace App\Controller\GardenArea;

use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\PageviewMixin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FreeGarden extends AbstractController {

    use  BreadCrumbMixin, PageviewMixin;

    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getKgvUrls (): ?KgvUrls {
        return $this->kgvUrls;
    }

    function getBreadCrumbChain (): BreadCrumbsChain {
        return $this->addGarden('freie Gärten', $this->generateUrl('gardenAreaFreeGarden'));
    }

    function getCategory (): ?string {
        return Categories::CATEGORY_AREA;
    }

    function getPageTitle (): ?string {
        return 'freie Gärten';
    }

    function getTemplate (): string {
        return 'garden/waitingList.twig';
    }

    protected function getIntroData (): ?array {
        return [
            'title' => 'Freie Gärten',
            'icon' => 'secateurs',
            'text' => 'Wenn Sie Interesse an einem Kleingarten haben, sind Sie hier richtig. Es gibt eine Warteliste auf der Sie sich eintragen lassen können, und die in chronologischer Reihenfolge "bedient" wird.',
        ];
    }

    /**
     * @Route("/anlage/freie-gaerten", name="gardenAreaFreeGarden")
     */
    function index (): Response {
        return $this->renderPageView();
    }
}
