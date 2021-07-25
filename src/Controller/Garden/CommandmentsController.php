<?php

namespace App\Controller\Garden;

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

class CommandmentsController extends AbstractController {

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
        return $this->addGardenArea('10 Gebote des Kleingärtners', null);
    }

    function getPageTitle (): ?string {
        return '10 Gebote des Kleingärtners';
    }

    function getTemplate (): string {
        return 'garden/commandments/index.twig';
    }

    protected function getIntroData (): ?array {
        return [
            'title' => '10 Gebote des Kleingärtners',
            'icon' => 'moving-machine-colored',
            'text' => 'Nicht alles ist in Gesetzen und Regeln festgeschrieben, was für ein harmonisches und friedliches Miteinander wichtig ist. <p>So sind unseren Vereinsmitgliedern und deren Gästen die 10 Gebote des Kleingärtners des <a target="_svnbg" href="https://kleingaertner-nuernberg.de/"><i class="fas fa-external-link-alt"></i> Stadtveband Nürnberg der Kleingärten e.V.</a> ans Herz gelegt.</p>',
        ];
    }

    /**
     * @Route("/mein-garten/10-gebote", name="gardenCommandments")
     * @param Request $request
     *
     * @return Response
     */
    public function index (Request $request): Response {
        return $this->renderPageView();
    }
}
