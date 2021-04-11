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

class CommandmentsController extends AbstractController {

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
        return $this->addGardenArea('10 Gebote des Kleingärtners', null);
    }

    function getPageTitle (): ?string {
        return '10 Gebote des Kleingärtners';
    }

    function getTemplate (): string {
        return 'garden_area/commandments/index.html.twig';
    }

    private function getIntroData (): ?array {
        return [
            'title' => '10 Gebote des Kleingärtners',
            'icon' => 'sun-colored',
            'text' => 'Nicht alles ist in Gesetzen und Regeln festgeschrieben, was für ein harmonisches und friedliches Miteinander wichtig ist. So sind unseren Vereinsmitgliedern und deren Gästen die 10 Gebote des Kleingärtners des <a target="_svnbg" href="https://kleingaertner-nuernberg.de/">Stadtveband Nürnberg</a> ans Herz gelegt. ',
        ];
    }

    /**
     * @Route("/gardenArea/commandments", name="gardenAreaCommandments")
     * @param Request $request
     *
     * @return Response
     */
    public function index (Request $request): Response {
        return $this->renderPageView();
    }
}
