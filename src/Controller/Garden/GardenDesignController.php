<?php

namespace App\Controller\Garden;

use App\Helper\BreadCrumbsChain;
use App\Helper\Categories;
use App\Helper\KgvUrls;
use App\Mixin\BreadCrumbMixin;
use App\Mixin\PageviewMixin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GardenDesignController extends AbstractController {

    use  BreadCrumbMixin, PageviewMixin;

    private KgvUrls $kgvUrls;

    function __construct (KgvUrls $kgvUrls) {
        $this->kgvUrls = $kgvUrls;
    }

    function getKgvUrls (): ?KgvUrls {
        return $this->kgvUrls;
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
        return 'garden/design/index.twig';
    }

    protected function getIntroData (): ?array {
        return [
            'title' => 'Gartengestaltung',
            'icon' => 'tree-colored',
            'text' => '<p>Jeder Gartenbesitzer kann seinen Garten nach eigenem Wunsch und Vorstellung gestalten und bewirtschaften.</p> <p>Natürlich müssen die Vorgaben des <a href="https://www.gesetze-im-internet.de/bkleingg/BJNR002100983.html" target="_new"><i class="fas fa-external-link-alt"></i>Bundeskleingartengesetzes</a>
            eingehalten werden. </p>',
        ];
    }

    /**
     * @Route("/mein-garten/garten-gestaltung", name="gardenGardenDesign")
     */
    public function index (): Response {
        return $this->renderPageView();
    }
}
